<?php

namespace ITLeague;

use Bitrix\Main\EventResult;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Delivery\Restrictions\Base;
use Bitrix\Sale\Internals\Entity;
use Bitrix\Sale\Shipment;

class DeliveryRestriction extends Base
{
    public static function onSaleDeliveryRestrictionsClassNamesBuildList(): EventResult
    {
        return new EventResult(EventResult::SUCCESS, ['\ITLeague\DeliveryRestriction' => __FILE__]);
    }

    public static function getClassTitle(): string
    {
        return 'только физические товары';
    }

    public static function getClassDescription(): string
    {
        return 'Доставка показывается только если в заказе есть товары, помимо сертификатов';
    }

    protected static function extractParams(Entity $entity)
    {
        if ($entity instanceof Shipment) {
            $basketItemProperties = [];
            foreach ($entity->getShipmentItemCollection() as $shipmentItem) {
                /** @var BasketItem $basketItem */
                $basketItem = $shipmentItem->getBasketItem();
                $basketItemProperties = array_merge($basketItemProperties, $basketItem->getPropertyCollection()->getPropertyValues());
            }
            return array_keys($basketItemProperties);
        }

        return null;
    }

    public static function getParamsStructure($entityId = 0): array
    {
        return array();
    }

    public static function check($params, array $restrictionParams, $serviceId = 0): bool
    {
        return is_array($params) && in_array('SIZE', $params, true);
    }
}