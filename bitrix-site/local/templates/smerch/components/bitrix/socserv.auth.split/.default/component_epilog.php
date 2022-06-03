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

if (isset($arResult["DB_SOCSERV_USER"]) && $arParams["SHOW_PROFILES"] !== 'N') {
    Extension::load(["itl_popup"]);
}
