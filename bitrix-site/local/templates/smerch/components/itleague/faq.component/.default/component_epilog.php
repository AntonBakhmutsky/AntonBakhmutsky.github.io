<?php

use Bitrix\Main\Page\Asset;

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $templateData
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var \FaqComponent $component
 */

if (count($arResult['ITEMS']) > 0) {
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/scripts/faq.js');
}
