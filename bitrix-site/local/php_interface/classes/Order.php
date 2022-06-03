<?php


namespace ITLeague;


use Bitrix\Main\Application;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\ArgumentTypeException;
use Bitrix\Main\Context;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Main\Loader;
use Bitrix\Main\NotImplementedException;
use Bitrix\Main\NotSupportedException;
use Bitrix\Main\ObjectNotFoundException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\DateTime;
use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Internals\OrderTable;
use Bitrix\Sale\Notify;
use Bitrix\Sale\OrderBase;
use Bitrix\Sale\Payment;
use Bitrix\Sale\PaymentCollection;
use Bitrix\Sale\ResultError;
use Bitrix\Sale\Shipment;
use Bitrix\Sale\ShipmentItem;
use CEventMessage;
use CFile;
use CIBlockElement;
use Exception;
use Ipolh\DPD\DB\Order\Table as DpdOrderTable;
use ITLeague\Certificates\Certificate;
use ITLeague\Certificates\Coupon;
use ITLeague\Certificates\Image;

class Order extends Notify
{
    public static function onBeforeCanceled(Event $event)
    {
        /** @var \Bitrix\Sale\Order $order */
        $order = $event->getParameter("ENTITY");
        if ($order->isCanceled()) {
            $order->setField("STATUS_ID", 'C');
        }
    }

    public static function onBeforeSaved(Event $event)
    {
        if (Context::getCurrent()->getRequest()->get('ORDER_USER_AGREEMENT') === 'N') {
            return new EventResult(
                EventResult::ERROR,
                new ResultError('Необходимо согласие с политикой конфиденциальности и пользовательским соглашением', 'SALE_EVENT_WRONG_ORDER'),
                'sale'
            );
        }

        /* delete certificates from shipment */
        /** @var \Bitrix\Sale\Order $order */
        $order = $event->getParameter("ENTITY");
        /** @var Shipment $shipment */
        foreach ($order->getShipmentCollection() as $shipment) {
            if ($shipment->isSystem()) {
                continue;
            }
            $shipmentItemCollection = $shipment->getShipmentItemCollection();
            /** @var ShipmentItem $shipmentItem */
            foreach ($shipmentItemCollection as $shipmentItem) {
                $basketItem = $shipmentItem->getBasketItem();
                if (array_key_exists('RATING', $basketItem->getPropertyCollection()->getPropertyValues())) {
                    $shipmentItem->setQuantity(0);
                    $shipmentItem->delete();
                    $shipmentItem->save();
                }
            }
        }

        if ($order->getFields()->isChanged('PAYED') && $order->isPaid()) {
            $onlyCert = true;
            /** @var BasketItem $basketItem */
            foreach ($order->getBasket()->getBasketItems() as $basketItem) {
                if (!array_key_exists("COUPON_1", $basketItem->getPropertyCollection()->getPropertyValues())) {
                    $onlyCert = false;
                    break;
                }
            }

            if ($onlyCert) {
                $order->setField('STATUS_ID', 'F');
            }
        }
    }

    /**
     * @throws ObjectNotFoundException
     * @throws NotImplementedException
     * @throws ArgumentNullException
     * @throws ArgumentTypeException
     * @throws ArgumentOutOfRangeException
     * @throws NotSupportedException
     * @throws ArgumentException
     * @throws Exception
     */
    public static function onAfterSaved(Event $event)
    {
        if ($event->getParameter('IS_NEW')) {
            /** @var \Bitrix\Sale\Order $order */
            $order = $event->getParameter("ENTITY");
            /** @var BasketItem $basketItem */
            foreach ($order->getBasket()->getBasketItems() as $basketItem) {
                if (array_key_exists('RATING', $values = $basketItem->getPropertyCollection()->getPropertyValues())) {
                    $certificate = new Certificate(intval($values['RATING']['VALUE']));
                    for ($i = 1; $i <= $basketItem->getQuantity(); $i++) {
                        $property = $basketItem->getPropertyCollection()->createItem();
                        $property->setFields([
                            'CODE' => "COUPON_$i",
                            'VALUE' => $certificate->createCoupon(),
                            'NAME' => 'Купон сертификата'
                        ]);
                        $basketItem->save();
                    }
                }
            }

            if ($order->getPrice() === 0.0 && !$order->isPaid()) {
                /** @var Payment $payment */
                foreach ($order->getPaymentCollection() as $payment) {
                    $payment->setPaid("Y");
                }
                $order->save();
            }
        }
    }

    /**
     * @throws ObjectNotFoundException
     * @throws ObjectPropertyException
     * @throws NotImplementedException
     * @throws ArgumentNullException
     * @throws ArgumentOutOfRangeException
     * @throws ArgumentException
     * @throws SystemException
     */
    public static function onPaid(Event $event)
    {
        /** @var \Bitrix\Sale\Order $order */
        $order = $event->getParameter("ENTITY");
        if ($order->isPaid()) {
            $propertyCollection = $order->getPropertyCollection();
            $emailProperty = $propertyCollection->getUserEmail();
            $userProperty = $propertyCollection->getPayerName();
            /** @var BasketItem $basketItem */
            foreach ($order->getBasket()->getBasketItems() as $basketItem) {
                for ($i = 1; $i <= $basketItem->getQuantity(); $i++) {
                    if (array_key_exists("COUPON_$i", $values = $basketItem->getPropertyCollection()->getPropertyValues())) {
                        $coupon = new Coupon($values["COUPON_$i"]['VALUE']);
                        $image = new Image($coupon, $basketItem->getPrice());

                        \Bitrix\Main\Mail\Event::send([
                            "EVENT_NAME" => "CERTIFICATE_PAID",
                            "LID" => "s1",
                            "C_FIELDS" => [
                                'USER' => $userProperty->getValue(),
                                "EMAIL" => $emailProperty->getValue(),
                                "COUPON" => $coupon->getCode(),
                                'RATING' => CurrencyFormat($basketItem->getPrice(), 'RUB')
                            ],
                            'FILE' => [$image->getFileId()]
                        ]);
                    }
                }
            }
        }
    }

    public static function onPaySendEmail(int $orderId, string &$eventName, array &$fields): bool
    {
        $order = \Bitrix\Sale\Order::load($orderId);
        $basketTableList = $basketTextList = '';
        /** @var Basket $basket */
        $basket = $order->getBasket();

        $send = false;
        if ($basket) {
            $separator = "<br/>";
            $filter = [
                "EVENT_NAME" => $eventName,
                'ACTIVE' => 'Y',
            ];

            if ($order instanceof OrderBase) {
                $filter['SITE_ID'] = $order->getSiteId();
            } elseif (defined('SITE_ID') && SITE_ID != '') {
                $filter['SITE_ID'] = SITE_ID;
            }

            $res = CEventMessage::GetList('', '', $filter);
            if ($eventMessage = $res->Fetch()) {
                if ($eventMessage['BODY_TYPE'] == 'text') {
                    $separator = "\n";
                }
            }

            $basketTextArray = $basket->getListOfFormatText();
            if (!empty($basketTextArray)) {
                foreach ($basketTextArray as $basketItemData) {
                    $basketTextList .= $basketItemData.$separator;
                }
            }

            /** @var \Bitrix\Sale\BasketItem $basketItem */
            foreach ($basket->getBasketItems() as $basketItem) {
                /* не отправлять письмо, если в заказе только сертификаты */
                if (!$send && !array_key_exists("COUPON_1", $basketItem->getPropertyCollection()->getPropertyValues())) {
                    $send = true;
                }

                $product = CIBlockElement::GetList(
                    [],
                    [
                        '=ID' => CIBlockElement::SubQuery(
                            "PROPERTY_CML2_LINK",
                            [
                                'ID' => $basketItem->getProductId()
                            ]
                        )
                    ],
                    false,
                    false,
                    ['PREVIEW_PICTURE']
                )->Fetch();
                $image = CFile::ResizeImageGet($product['PREVIEW_PICTURE'], ['width' => 60, 'height' => 60], BX_RESIZE_IMAGE_EXACT, true);
                $sizeName = '';

                /** @var \Bitrix\Sale\BasketPropertiesCollection $basketPropertyCollection */
                if ($basketPropertyCollection = $basketItem->getPropertyCollection()) {
                    /** @var \Bitrix\Sale\BasketPropertyItem $basketPropertyItem */
                    foreach ($basketPropertyCollection as $basketPropertyItem) {
                        if ($basketPropertyItem->getField('CODE') === "SIZE") {
                            $sizeName = $basketPropertyItem->getField('VALUE') ?? '';
                            break;
                        }
                    }
                }
                $basketTableList .= '<tr>
                    <td style="padding: 10px 12px">
                        <table role="presentation" aria-hidden="true" align="center" border="0"
                               cellpadding="0" cellspacing="0" width="100%"
                               style="table-layout: auto;">
                            <tbody>
                            <tr>
                                <td align="left" style="padding-bottom: 10px;"><p
                                        style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 0; text-transform: uppercase; ">
                                    '.$basketItem->getField('NAME').'</p></td>
                            </tr>
                            <tr valign="center" height="60">
                                <td><img src="'.$image['src'].'" width="'.$image['width'].'" height="'.$image['height'].'">
                                </td>
                                <td width="28">Размер: '.$sizeName.'</td>
                                <td align="center" style="padding:0 10px;"><p
                                        style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 0; white-space: nowrap;">
                                    '.$basketItem->getQuantity().' шт</p></td>
                                <td align="right" width="88px" style="padding-left: 25px;"><p
                                        style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 0; white-space: nowrap;">
                                    '.CurrencyFormat($basketItem->getFinalPrice(), $basketItem->getCurrency()).'</p></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>';
            }
        }

        $fields['TABLE_ORDER_LIST'] = $basketTableList;
        $fields['ORDER_LIST'] = $basketTextList;
        $fields['TOTAL_SUM'] = CurrencyFormat($order->getPrice(), $order->getCurrency());
        $fields["ORDER_USER"] = static::getUserName($order);

        \Bitrix\Main\Mail\Event::send([
            "EVENT_NAME" => "ORDER_PAID_ADMIN",
            "LID" => "s1",
            "C_FIELDS" => $fields,
            'LANGUAGE_ID' => 'ru'
        ]);

        return $send;
    }

    public static function onSelectMessageIdForEmail(
        string $eventName,
        string $lid,
        array &$arFields,
        string &$messageId = '',
        array $files = [],
        string $languageId = ''
    ): bool {
        if (in_array($eventName, ['SALE_ORDER_TRACKING_NUMBER', 'SALE_ORDER_PAID', 'SALE_STATUS_CHANGED_D'], true)) {
            $order = \Bitrix\Sale\Order::load($arFields['ORDER_ID']);

            /** @var Shipment $shipment */
            foreach ($order->getShipmentCollection()->getNotSystemItems() as $shipment) {
                $eventMessageMap = [];
                $filter = [
                    "EVENT_NAME" => $eventName,
                    'ACTIVE' => 'Y',
                ];
                if ($order instanceof OrderBase) {
                    $filter['SITE_ID'] = $order->getSiteId();
                } elseif (defined('SITE_ID') && SITE_ID != '') {
                    $filter['SITE_ID'] = SITE_ID;
                }
                $dbEventMessage = CEventMessage::GetList('', '', $filter);
                while ($eventMessage = $dbEventMessage->Fetch()) {
                    foreach ($eventMessage['ADDITIONAL_FIELD'] as $field) {
                        if ($field['NAME'] === 'type') {
                            $eventMessageMap[$field['VALUE']] = (int) $eventMessage['ID'];
                        }
                    }
                }

                switch ($shipment->getDelivery()->getCode()) {
                    case 'ipolh_dpd:COURIER':
                        if ($eventName === 'SALE_STATUS_CHANGED_D') {
                            return false;
                        }
                        $messageId = $eventMessageMap['dpd_door'];
                        break;
                    case 'ipolh_dpd:PICKUP':
                        if ($eventName === 'SALE_STATUS_CHANGED_D') {
                            return false;
                        }
                        $messageId = $eventMessageMap['dpd_point'];
                        break;
                    default:
                        $messageId = $eventMessageMap['pickup'] ?? '';
                        $arFields['ORDER_USER'] = Notify::getUserName($order);
                        break;
                }

                break;
            }
        }

        return true;
    }

    public static function deleteUnpaidOrders(): string
    {
        $date = new DateTime();
        $date->add('-1day');
        foreach (
            OrderTable::getList(
                [
                    'filter' => [
                        '<DATE_STATUS' => $date,
                        'STATUS_ID' => 'N'
                    ],
                    'select' => ['ID'],
                    'limit' => 50
                ]
            )->fetchCollection() as $order
        ) {
            $connection = Application::getConnection();
            $connection->startTransaction();

            try {
                OrderTable::delete($order->getId());
                if (Loader::includeModule('ipol.dpd')
                    && $dpdOrder = DpdOrderTable::getList(
                        [
                            'filter' => ['=ORDER_ID' => $order->getId()],
                            'select' => ['ID'],
                            'limit' => 1
                        ]
                    )->fetchObject()) {
                    DpdOrderTable::delete($dpdOrder->getId());
                }
                $connection->commitTransaction();
            } catch (Exception $e) {
                $connection->rollbackTransaction();
                throw $e;
            }
        }

        return '\ITLeague\Order::deleteUnpaidOrders();';
    }
}
