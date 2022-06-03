<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */

if ($arResult['URL']) {
    $url = htmlspecialcharsbx(CUtil::JSEscape($arResult['URL']));
    $label = htmlspecialcharsbx($arResult['LABEL']);
    $label = explode('%', $label);
    $label = implode(
        '',
        array_merge(
            array_slice($label, 0, 1),
            ['<a href="' . $url . '" target="_blank">'],
            array_slice($label, 1, 1),
            ['</a>'],
            array_slice($label, 2)
        )
    );
} else {
    $label = htmlspecialcharsbx($arResult['INPUT_LABEL']);
}
$arResult['LABEL'] = $label;
