<?php


/** @var CUser $USER */

/** @var array $arParams */
/** @var array $arResult */

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;
use Bitrix\Sale\Internals\StatusLangTable;
use Bitrix\Sale\Order;
use ITLeague\Helpers\Iblock;
use Bitrix\Sale\PaySystem\BaseServiceHandler;

Loader::includeModule('highloadblock');

foreach ($arResult['ORDERS'] as &$array) {
    $order = Order::load($array['ORDER']['ID']);
    $paymentCollection = $order->getPaymentCollection();
    
    if ($paymentCollection) {
        foreach ($array['PAYMENT'] as &$payment) {
            /** @var \Bitrix\Sale\Payment $paymentItem */
            $paymentItem = $paymentCollection->getItemById($payment['ID']);
            if ($paymentItem) {
                $initResult = $paymentItem->getPaySystem()->initiatePay($paymentItem, null, BaseServiceHandler::STRING);
                if ($initResult->isSuccess()) {
                    $payment['BUFFERED_OUTPUT'] = $initResult->getTemplate();
                } else {
                    $payment['ERROR'] = implode('\n', $initResult->getErrorMessages());
                }
            }
        }
    }
}

$statuses = StatusLangTable::getList(['filter' => ['=STATUS.TYPE' => 'O', '=LID' => 'ru']])->fetchCollection();
foreach ($statuses as $status) {
    $arResult['INFO']['STATUS'][$status->getStatusId()]['DESCRIPTION'] = $status->getDescription();
}

$arResult['INFO']['SIZES'] = $arResult['INFO']['RATING'] = [];
$hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => 'ProductSizes']]);
$entity = HighloadBlockTable::compileEntity($hlBlock);
$entityDataClass = $entity->getDataClass();
$sizes = $entityDataClass::getList();
while ($size = $sizes->fetch()) {
    $arResult['INFO']['SIZES'][$size['UF_XML_ID']] = $size;
}

$offersIds = [];
$arResult['INFO']['PICTURES'] = [];
foreach ($arResult['ORDERS'] as $order) {
    foreach ($order['BASKET_ITEMS'] as $basketItem) {
        $offersIds[] = (int)$basketItem['PRODUCT_ID'];
    }
}
$offers = CIBlockElement::GetList(
    [],
    ['=ID' => array_unique($offersIds)],
    false,
    false,
    ['ID', 'PREVIEW_PICTURE', 'PROPERTY_CML2_LINK.PREVIEW_PICTURE', 'PROPERTY_SIZE']
);
while ($offer = $offers->Fetch()) {
    $arResult['INFO']['PICTURES'][$offer['ID']] = [
        'PREVIEW' =>
            CFile::ResizeImageGet(
                $offer['PROPERTY_CML2_LINK_PREVIEW_PICTURE'] ?? $offer['PREVIEW_PICTURE'],
                ['width' => 500, 'height' => 260],
                BX_RESIZE_IMAGE_EXACT,
                true
            ),
        'SIZE' => $offer['PROPERTY_SIZE_VALUE'] ? CFile::GetPath($arResult['INFO']['SIZES'][$offer['PROPERTY_SIZE_VALUE']]['UF_FILE']) : false
    ];
}
$offers = CIBlockElement::GetList(
    [],
    ['=ID' => array_unique($offersIds), 'IBLOCK_ID' => Iblock::getId('poshtuchno_offers')],
    false,
    false,
    ['ID', 'PROPERTY_RATING']
);
while ($offer = $offers->Fetch()) {
    $arResult['INFO']['RATING'][$offer['ID']] = $offer['PROPERTY_RATING_VALUE'];
}

