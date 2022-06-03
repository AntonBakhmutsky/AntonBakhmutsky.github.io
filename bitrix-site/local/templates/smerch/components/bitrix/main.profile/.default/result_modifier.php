<?php

/**
 * @var \CUser $USER
 * @var array $arParams
 * @var array $arResult
 */

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arResult['CAN_EDIT_PASSWORD'] = $arResult['arUser']['EXTERNAL_AUTH_ID'] == ''
    || in_array($arResult['arUser']['EXTERNAL_AUTH_ID'], $arParams['EDITABLE_EXTERNAL_AUTH_ID'], true);
