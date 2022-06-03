<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */

/** @var array $arResult */

use ITLeague\Helpers\Iblock;

$dbProducts = CIBlockElement::GetList([], [
    'IBLOCK_ID' => Iblock::getId('poshtuchno'),
    '!=ID' => CIBlockElement::SubQuery("PROPERTY_CML2_LINK", array(
        "IBLOCK_ID" => Iblock::getId('poshtuchno_offers'),
        "ID" => array_map(fn(array $basketItem) => $basketItem['PRODUCT_ID'], $arResult['BASKET_ITEM_RENDER_DATA']),
    )),
    '!=PROPERTY_BASKET_POPUP' => false,
    '=AVAILABLE' => 'Y'
], false, ['nTopCount' => 1], ['ID']);
$arResult['BASKET_POPUP_PRODUCT_ID'] = ($p = $dbProducts->Fetch()) ? (int)$p['ID'] : null;

