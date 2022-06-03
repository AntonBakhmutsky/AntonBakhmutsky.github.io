<?php


/** @var array $arParams */

/** @var array $arResult */
/** @var \CBitrixComponent $component */

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

if ($arParams['SHOW_PRIVATE_PAGE'] !== 'Y') {
    LocalRedirect($arParams['SEF_FOLDER']);
}

if ($arParams['SET_TITLE'] == 'Y') {
    app()->SetTitle(Loc::getMessage("SPS_TITLE_PRIVATE"));
}

app()->SetTitle('Личные данные');

app()->IncludeComponent(
    "bitrix:main.profile",
    "",
    [
        "SET_TITLE" => $arParams["SET_TITLE"],
        "AJAX_MODE" => $arParams['AJAX_MODE_PRIVATE'],
        "SEND_INFO" => $arParams["SEND_INFO_PRIVATE"],
        "CHECK_RIGHTS" => $arParams['CHECK_RIGHTS_PRIVATE'],
        "EDITABLE_EXTERNAL_AUTH_ID" => $arParams['EDITABLE_EXTERNAL_AUTH_ID'],
    ],
    $component
);
