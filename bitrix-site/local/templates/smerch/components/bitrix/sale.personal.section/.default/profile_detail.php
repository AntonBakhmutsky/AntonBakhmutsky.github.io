<?php


/** @var array $arParams */

/** @var array $arResult */
/** @var \CBitrixComponent $component */

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

app()->SetTitle('Мой адрес');

if ($arParams['SHOW_PROFILE_PAGE'] !== 'Y') {
    LocalRedirect($arParams['SEF_FOLDER']);
}

app()->IncludeComponent(
    "bitrix:sale.personal.profile.detail",
    "",
    [
        "PATH_TO_LIST" => $arResult["PATH_TO_PROFILE"],
        "PATH_TO_DETAIL" => $arResult["PATH_TO_PROFILE_DETAIL"],
        "SET_TITLE" => $arParams["SET_TITLE"],
        "USE_AJAX_LOCATIONS" => $arParams['USE_AJAX_LOCATIONS_PROFILE'],
        "COMPATIBLE_LOCATION_MODE" => $arParams['COMPATIBLE_LOCATION_MODE_PROFILE'],
        "ID" => $arResult["VARIABLES"]["ID"],
    ],
    $component
);
