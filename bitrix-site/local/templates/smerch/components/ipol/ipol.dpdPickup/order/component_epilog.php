<?php

use Bitrix\Main\UI\Extension;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

Extension::registerAssets(
    'ipolhDpdMap',
    [
        'lang' => $templateFolder . '/lang/' . LANGUAGE_ID . '/template.php',
        'rel' => ['ajax', 'itl_popup'],
    ]
);

Extension::load('ipolhDpdMap');
