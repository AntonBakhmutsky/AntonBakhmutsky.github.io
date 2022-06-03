<?php

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @var \CatalogItemComponent $component
 */

$item = $arResult['ITEM'];
if (empty($item['ITEM_START_PRICE'])) {
    $minPrice = null;
    $minPriceIndex = null;
    foreach (array_keys($item['OFFERS']) as $index) {
        $currentPrice = $item['OFFERS'][$index]['ITEM_PRICES'][$item['OFFERS'][$index]['ITEM_PRICE_SELECTED']];
        $priceScale = $currentPrice['RATIO_PRICE'];
        if ($minPrice === null || $minPrice > $priceScale) {
            $minPrice = $priceScale;
            $minPriceIndex = $index;
        }
        unset($priceScale, $currentPrice);
    }
    unset($offer);
    
    if ($minPriceIndex !== null) {
        $minOffer = $item['OFFERS'][$minPriceIndex];
        $item['ITEM_START_PRICE_SELECTED'] = $minPriceIndex;
        $item['ITEM_START_PRICE'] = $minOffer['ITEM_PRICES'][$minOffer['ITEM_PRICE_SELECTED']];
        unset($minOffer);
    }
    unset($minPriceIndex, $minPrice);
    
    $arResult['ITEM'] = $item;
}
