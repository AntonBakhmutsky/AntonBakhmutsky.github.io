<?php

use Bitrix\Iblock\Elements\ElementSizesTable;
use Bitrix\Main\Loader;
use Dev2fun\Module\OpenGraph;
use ITLeague\Components\MetaData\ElementMetaData;

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

Loader::includeModule('dev2fun.opengraph');
OpenGraph::Show($component->arResult['ID']);

$component->arResult['META_DATA'] = new ElementMetaData($component->arResult);
if($sizesTypeId = $component->arResult['PROPERTIES']['SIZES_TYPE']['VALUE']) {
    $component->arResult['PROPERTIES']['SIZES_TYPE']['VALUE_CODE'] = ElementSizesTable::getByPrimary($sizesTypeId, ['select' => ['CODE']])->fetchObject()->getCode();
}
$component->SetResultCacheKeys(['META_DATA']);
