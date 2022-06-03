<?php


/** @var array $arParams */

/** @var array $arResult */
/** @var \CBitrixComponent $component */

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

app()->SetTitle('Отмена заказа');

if ($arParams['SHOW_ORDER_PAGE'] !== 'Y') {
    LocalRedirect($arParams['SEF_FOLDER']);
} elseif ($arParams['ORDER_DISALLOW_CANCEL'] === 'Y') {
    LocalRedirect($arResult['PATH_TO_ORDERS']);
}

app()->IncludeComponent(
    "bitrix:sale.personal.order.cancel",
    "",
    [
        "PATH_TO_LIST" => $arResult["PATH_TO_ORDERS"],
        "PATH_TO_DETAIL" => $arResult["PATH_TO_ORDER_DETAIL"],
        "SET_TITLE" => $arParams["SET_TITLE"],
        "ID" => $arResult["VARIABLES"]["ID"],
    ],
    $component
);
