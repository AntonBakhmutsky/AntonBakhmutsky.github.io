<?php


/** @var \CUser $USER */
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

foreach ($arResult['ITEMS'] as &$item) {
    $item['PREVIEW_TEXT'] = str_replace('#TABLE#', $this->getComponent()::getTableHtml($item['TABLE']), $item['PREVIEW_TEXT']);
}
