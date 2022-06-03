<?php


/** @var array $arParams */

/** @var array $arResult */
/** @var \CBitrixComponent $component */

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if ($arParams['SHOW_PROFILE_PAGE'] !== 'Y') {
    LocalRedirect($arParams['SEF_FOLDER']);
}

app()->SetTitle('Мои адреса');

app()->IncludeComponent(
    "bitrix:sale.personal.profile.list",
    "",
    [
        "PATH_TO_DETAIL" => $arResult['PATH_TO_PROFILE_DETAIL'],
        "PATH_TO_DELETE" => $arResult['PATH_TO_PROFILE_DELETE'],
        "PER_PAGE" => $arParams["PROFILES_PER_PAGE"],
        "SET_TITLE" => $arParams["SET_TITLE"],
    ],
    $component
);
