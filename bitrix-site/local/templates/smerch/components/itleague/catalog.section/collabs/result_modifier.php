<?php

use Bitrix\Main\Loader;
use Bitrix\Main\ORM\Fields\FieldTypeMask;
use Bitrix\Main\ORM\Objectify\Values;
use Dev2fun\Module\OpenGraph;
use ITLeague\Components\MetaData\SectionMetaData;
use ITLeague\Iblock\Section;
use ITLeague\Iblock\SectionTable;

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
    
    Loader::includeModule('dev2fun.opengraph');
    OpenGraph::Show($component->arResult['ID'],'section');
    
    $component->arResult['META_DATA'] = new SectionMetaData($component->arResult);
    
    SectionTable::setIblockId($component->arResult['IBLOCK_ID']);
    $sections = SectionTable::query()
        ->setFilter(
            [
                '=ACTIVE' => 'Y',
                '=IBLOCK_SECTION_ID' => $component->arResult['ID'],
                '=DEPTH_LEVEL' => 2
            ]
        )
        ->setSelect(['ID', 'IBLOCK_ID', 'NAME', 'UF_ITEMS_IN_RAW'])
        ->setOrder(['SORT' => 'ASC'])
        ->setLimit(100)
        ->fetchCollection();
    
    $component->arResult['SECTIONS'] = array_combine(
        $sections->getIdList(),
        array_map(fn(Section $section) => $section->collectValues(Values::ALL, FieldTypeMask::SCALAR | FieldTypeMask::USERTYPE), $sections->getAll())
    );
    
    $component->SetResultCacheKeys(['META_DATA', 'SECTIONS', 'DEPTH_LEVEL']);
}
