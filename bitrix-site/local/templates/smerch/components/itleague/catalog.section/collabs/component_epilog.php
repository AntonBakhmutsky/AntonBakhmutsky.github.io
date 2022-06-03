<?php

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Context;
use ITLeague\Iblock\SectionTable;

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var array $templateData
 * @var string $templateFolder
 * @var CatalogSectionComponent $component
 */

// Redirect to first level of sections
if ((int)$arResult['DEPTH_LEVEL'] > 1) {
    $iblock = IblockTable::query()
        ->setFilter(['=IBLOCK_TYPE_ID' => 'catalog', '=CODE' => 'collabs'])
        ->setLimit(1)
        ->setSelect(['ID', 'LID', 'CODE', 'SECTION_PAGE_URL'])
        ->fetchObject();
    
    SectionTable::setIblockId($iblock->getId());
    $parentSection = SectionTable::query()
        ->setFilter(
            ['=ID' => $arResult['IBLOCK_SECTION_ID']]
        )
        ->setSelect(['ID', 'IBLOCK_ID', 'CODE'])
        ->setLimit(1)
        ->fetch();
    
    if ($parentSection) {
        LocalRedirect(CIBlock::ReplaceDetailUrl($iblock->getSectionPageUrl(), $parentSection, true, 'S'));
    }
}


if ($arParams['SET_TITLE'] === true) {
    $arResult['META_DATA']->set();
}


//	lazy load and big data json answers
$request = Context::getCurrent()->getRequest();
if ($request->isAjaxRequest() && ($request->get('action') === 'showMore' || $request->get('action') === 'deferredLoad')) {
    $content = ob_get_contents();
    ob_end_clean();
    
    [, $itemsContainer] = explode('<!-- items-container -->', $content);
    [, $paginationContainer] = explode('<!-- pagination-container -->', $content);
    [, $epilogue] = explode('<!-- component-end -->', $content);
    
    if ($arParams['AJAX_MODE'] === 'Y') {
        $component->prepareLinks($paginationContainer);
    }
    
    $component::sendJsonAnswer(
        [
            'items' => $itemsContainer,
            'pagination' => $paginationContainer,
            'epilogue' => $epilogue,
        ]
    );
}

