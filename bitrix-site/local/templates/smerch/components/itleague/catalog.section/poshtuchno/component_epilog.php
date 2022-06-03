<?php

use Bitrix\Main\Context;

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


if ($arParams['SET_TITLE'] === true) {
    $arResult['META_DATA']->set();
    if ($arResult['IBLOCK']['DESCRIPTION']) {
        app()->SetPageProperty('og:description', $arResult['IBLOCK']['DESCRIPTION']);
    }
    if ($arResult['IBLOCK']['PICTURE']) {
        app()->SetPageProperty('og:image', CFile::GetPath($arResult['IBLOCK']['PICTURE']));
    }
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
