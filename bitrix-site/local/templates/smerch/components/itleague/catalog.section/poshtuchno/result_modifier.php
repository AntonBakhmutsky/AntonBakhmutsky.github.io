<?php

use Bitrix\Iblock\IblockTable;
use ITLeague\Components\MetaData\IblockMetaData;

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

if ($arParams['SET_TITLE'] === true) {
    $component->arResult['META_DATA'] = IblockMetaData::create($component->arResult['IBLOCK_ID']);
    $component->arResult['IBLOCK'] = IblockTable::query()
        ->setFilter(['=ID' => $component->arResult['IBLOCK_ID'], '=IBLOCK_TYPE_ID' => $arParams['IBLOCK_TYPE'], '=ACTIVE' => 'Y'])
        ->setLimit(1)
        ->setSelect(['ID', 'PICTURE', 'DESCRIPTION'])
        ->fetch();
    $component->SetResultCacheKeys(['META_DATA', 'IBLOCK']);
}

