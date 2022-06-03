<?php

use Bitrix\Main\Web\Json;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @global string $componentPath
 * @global string $templateName
 * @var CBitrixComponentTemplate $this
 * @var array $arParams
 * @var array $arResult
 */
$cartId = "bx_basket" . $this->randString();
$arParams['cartId'] = $cartId;

?>
<script>
	var <?=$cartId?> = new BitrixSmallCart;
</script>

<div id="<?= $cartId ?>" class="header__links">
    
    <?php
    if ($arParams['SHOW_PERSONAL_LINK'] == 'Y') { ?>
		<a href="<?= $arParams['PATH_TO_PERSONAL'] ?>" class="<?php
        app()->ShowProperty('PERSONAL_ICON_CLASS') ?>"></a>
        <?php
    }
    
    if (! $arResult["DISABLE_USE_BASKET"]) { ?>
		<a href="<?= $arParams['PATH_TO_BASKET'] ?>" class="<?php
        app()->ShowProperty('BASKET_ICON_CLASS') ?>">
			<div id="<?= $cartId ?>_frame">
                <?php
                /** @var \Bitrix\Main\Page\FrameBuffered $frame */
                $frame = $this->createFrame("{$cartId}_frame", false)->begin();
                
                if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y')) { ?>
					<span class="header__links-counter"><?= $arResult['NUM_PRODUCTS'] ?></span>
                    <?php
                }
                $frame->beginStub();
                $frame->end();
                ?>
			</div>
		</a>
        <?php
    } ?>

</div>
<script type="text/javascript">
    <?=$cartId?>.siteId = '<?= SITE_ID?>';
    <?=$cartId?>.cartId = '<?= $cartId?>';
    <?=$cartId?>.ajaxPath = '<?= $componentPath?>/ajax.php';
    <?=$cartId?>.templateName = '<?= $templateName?>';
    <?=$cartId?>.arParams = <?= Json::encode($arParams)?>;
    <?=$cartId?>.closeMessage = '<?= GetMessage('TSB1_COLLAPSE')?>';
    <?=$cartId?>.openMessage = '<?= GetMessage('TSB1_EXPAND')?>';
    <?=$cartId?>.activate();
</script>
