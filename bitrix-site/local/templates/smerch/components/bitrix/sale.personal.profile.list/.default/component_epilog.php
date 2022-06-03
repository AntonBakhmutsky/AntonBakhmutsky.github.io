<?php

use Bitrix\Main\UI\Extension;

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $templateData
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 */

if (is_array($arResult["PROFILES"]) && ! empty($arResult["PROFILES"])) {
    Extension::load('itl_popup');
}
