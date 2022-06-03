<?php


/** @var array $arParams */

/** @var array $arResult */
/** @var \CBitrixComponent $component */

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

app()->SetTitle('Заказ №' . $arResult["VARIABLES"]["ID"]);

if ($arParams['SHOW_ORDER_PAGE'] !== 'Y') {
    LocalRedirect($arParams['SEF_FOLDER']);
}

$arDetParams = [
    "PATH_TO_LIST" => $arResult["PATH_TO_ORDERS"],
    "PATH_TO_CANCEL" => $arResult["PATH_TO_ORDER_CANCEL"],
    "PATH_TO_COPY" => $arResult["PATH_TO_ORDER_COPY"],
    "PATH_TO_PAYMENT" => $arParams["PATH_TO_PAYMENT"],
    "SET_TITLE" => $arParams["SET_TITLE"],
    "ID" => $arResult["VARIABLES"]["ID"],
    "ACTIVE_DATE_FORMAT" => $arParams["ACTIVE_DATE_FORMAT"],
    "ALLOW_INNER" => $arParams["ALLOW_INNER"],
    "ONLY_INNER_FULL" => $arParams["ONLY_INNER_FULL"],
    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
    "CACHE_TIME" => $arParams["CACHE_TIME"],
    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
    "RESTRICT_CHANGE_PAYSYSTEM" => $arParams["ORDER_RESTRICT_CHANGE_PAYSYSTEM"],
    "DISALLOW_CANCEL" => $arParams["ORDER_DISALLOW_CANCEL"],
    "REFRESH_PRICES" => $arParams["ORDER_REFRESH_PRICES"],
    "HIDE_USER_INFO" => $arParams["ORDER_HIDE_USER_INFO"],
    
    "CUSTOM_SELECT_PROPS" => $arParams["CUSTOM_SELECT_PROPS"],
    'PICTURE_WIDTH' => 500,
    'PICTURE_HEIGHT' => 260,
    'PICTURE_RESAMPLE_TYPE' => BX_RESIZE_IMAGE_EXACT
];
foreach ($arParams as $key => $val) {
    if (mb_strpos($key, "PROP_") !== false) {
        $arDetParams[$key] = $val;
    }
}

app()->IncludeComponent(
    "bitrix:sale.personal.order.detail",
    "",
    $arDetParams,
    $component
);
