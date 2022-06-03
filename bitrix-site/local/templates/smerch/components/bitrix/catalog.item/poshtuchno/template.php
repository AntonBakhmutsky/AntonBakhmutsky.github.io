<?

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var CatalogProductsViewedComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

if (isset($arResult['ITEM'])) {
    $item = $arResult['ITEM'];
    $areaId = $arResult['AREA_ID'];
    $itemIds = [
        'ID' => $areaId,
        'PICT' => $areaId . '_pict',
        'SECOND_PICT' => $areaId . '_secondpict',
        'PICT_SLIDER' => $areaId . '_pict_slider',
        'STICKER_ID' => $areaId . '_sticker',
        'SECOND_STICKER_ID' => $areaId . '_secondsticker',
        'QUANTITY' => $areaId . '_quantity',
        'QUANTITY_DOWN' => $areaId . '_quant_down',
        'QUANTITY_UP' => $areaId . '_quant_up',
        'QUANTITY_MEASURE' => $areaId . '_quant_measure',
        'QUANTITY_LIMIT' => $areaId . '_quant_limit',
        'BUY_LINK' => $areaId . '_buy_link',
        'BASKET_ACTIONS' => $areaId . '_basket_actions',
        'NOT_AVAILABLE_MESS' => $areaId . '_not_avail',
        'SUBSCRIBE_LINK' => $areaId . '_subscribe',
        'COMPARE_LINK' => $areaId . '_compare_link',
        'PRICE' => $areaId . '_price',
        'PRICE_OLD' => $areaId . '_price_old',
        'PRICE_TOTAL' => $areaId . '_price_total',
        'DSC_PERC' => $areaId . '_dsc_perc',
        'SECOND_DSC_PERC' => $areaId . '_second_dsc_perc',
        'PROP_DIV' => $areaId . '_sku_tree',
        'PROP' => $areaId . '_prop_',
        'DISPLAY_PROP_DIV' => $areaId . '_sku_prop',
        'BASKET_PROP_DIV' => $areaId . '_basket_prop',
    ];
    
    $imgTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] !== ''
        ? $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
        : '';
    
    $imgAlt = isset($item['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']) && $item['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'] !== ''
        ? $item['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
        : $item['NAME'];
    
    $skuProps = [];
    
    $haveOffers = ! empty($item['OFFERS']);
    if ($haveOffers) {
        $actualItem = isset($item['OFFERS'][$item['OFFERS_SELECTED']])
            ? $item['OFFERS'][$item['OFFERS_SELECTED']]
            : reset($item['OFFERS']);
    } else {
        $actualItem = $item;
    }
    
    if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers) {
        $minPrice = $item['ITEM_START_PRICE'];
        $minOffer = $item['OFFERS'][$item['ITEM_START_PRICE_SELECTED']];
        $maxPrice = $item['ITEM_END_PRICE'];
        $measureRatio = $minOffer['ITEM_MEASURE_RATIOS'][$minOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
        $morePhoto = $item['MORE_PHOTO'];
    } else {
        $minPrice = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
        $measureRatio = $minPrice['MIN_QUANTITY'];
        $morePhoto = $actualItem['MORE_PHOTO'];
    }
    
    $picture = CFile::ResizeImageGet($item['PREVIEW_PICTURE']['ID'], ['width' => 504, 'height' => 504], BX_RESIZE_IMAGE_EXACT, true);
    ?>
	
	<a class="tile-card" id="<?= $areaId ?>" href="<?= $item['DETAIL_PAGE_URL'] ?>" data-entity="item">
		<div class="tile-card__image" data-entity="image-wrapper">
			<img src="<?= $picture['src'] ?>" alt="<?= $imgAlt ?>"
			     width="<?= $picture['width'] ?>" height="<?= $picture['height'] ?>"
                <?= $imgTitle ? 'title="' . $imgTitle . '"' : '' ?>>
		</div>
		<div class="tile-card__text"><?= $item['NAME'] ?></div>
        <?php
        $canBuy = $item['CAN_BUY'];
        foreach ($item['OFFERS'] as $offer) {
            if ($offer['CAN_BUY']) {
                $canBuy = true;
            }
        }
        if ($canBuy && ! empty($minPrice)) {
            ?>
            <div class="tile-card__price">
                <?php
                if (isset($maxPrice) && $minPrice['PRICE'] < $maxPrice['PRICE']) { ?>
                    от <?= $minPrice['PRINT_RATIO_PRICE'] ?> до <?= $maxPrice['PRINT_RATIO_PRICE'] ?>
                <?php
                } else { ?>
                    <?= $minPrice['PRINT_RATIO_PRICE'] ?>
                <?php
                } ?>
            </div>
            <?php
        } else { ?>
			<div class="tile-card__not-available">Нет в наличии</div>
            <?php
        } ?>
	
	</a>
    <?php
}
