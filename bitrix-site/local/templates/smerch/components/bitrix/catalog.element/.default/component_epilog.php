<?php

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\UI\Extension;

/**
 * @var array $templateData
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 */


if (! empty($templateData['TEMPLATE_LIBRARY'])) {
    $loadCurrency = false;
    
    if (! empty($templateData['CURRENCIES'])) {
        $loadCurrency = Loader::includeModule('currency');
    }
    
    Extension::load($templateData['TEMPLATE_LIBRARY']);
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/scripts/catalog.element.js');
    if ($loadCurrency) {
        ?>
		<script>
			BX.Currency.setCurrencies(<?=$templateData['CURRENCIES']?>);
		</script>
        <?php
    }
}

if (isset($templateData['JS_OBJ'])) {
    ?>
	<script>
		BX.ready(BX.defer(function () {
			if (!!window.<?=$templateData['JS_OBJ']?>) {
				window.<?=$templateData['JS_OBJ']?>.allowViewedCount(true);
			}
		}));
	</script>
    
    
    <?php
    // select target offer
    $request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
    $offerNum = false;
    $offerId = (int)$this->request->get('OFFER_ID');
    $offerCode = $this->request->get('OFFER_CODE');
    
    if ($offerId > 0 && ! empty($templateData['OFFER_IDS']) && is_array($templateData['OFFER_IDS'])) {
        $offerNum = array_search($offerId, $templateData['OFFER_IDS']);
    } elseif (! empty($offerCode) && ! empty($templateData['OFFER_CODES']) && is_array($templateData['OFFER_CODES'])) {
        $offerNum = array_search($offerCode, $templateData['OFFER_CODES']);
    }
    
    if (! empty($offerNum)) {
        ?>
		<script>
			BX.ready(function () {
				if (!!window.<?=$templateData['JS_OBJ']?>) {
					window.<?=$templateData['JS_OBJ']?>.setOffer(<?=$offerNum?>);
				}
			});
		</script>
        <?php
    }
}

$arResult['META_DATA']->set();
$GLOBALS['elementSection'] = $arResult['META_DATA']->getSection()['ID'] ?? false;
