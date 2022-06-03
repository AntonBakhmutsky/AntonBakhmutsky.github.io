<?php

use Bitrix\Main\Page\Asset;
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

Extension::load(["itl_popup"]);
if(!is_null($arResult['BASKET_POPUP_PRODUCT_ID'])) {
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/components/bitrix/catalog.element/basket.popup/script.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/scripts/splide.js');
}