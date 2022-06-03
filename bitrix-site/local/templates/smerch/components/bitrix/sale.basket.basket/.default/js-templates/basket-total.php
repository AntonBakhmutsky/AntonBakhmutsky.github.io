<?
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
    <?
    if ($arParams['HIDE_COUPON'] !== 'Y') {
        ?>
		<div class="coupon">
			<div class="basket-coupon-section">
				<div class="basket-coupon-block-field">
					<div class="basket-coupon-block-field-description">
                        <?= Loc::getMessage('SBB_COUPON_ENTER') ?>:
					</div>
					<div class="form">
						<div class="form-group" style="position: relative;">
							<input type="text" class="form-control" id="" placeholder="" data-entity="basket-coupon-input">
							<span class="basket-coupon-block-coupon-btn">ПРИМЕНИТЬ ПРОМОКОД</span>
							<div class="basket-coupon-alert-section">
								<div class="basket-coupon-alert-inner">
									{{#COUPON_LIST}}
									<div class="basket-coupon-alert text-{{CLASS}}">
                                        <span class="basket-coupon-text">
                                            <strong>{{COUPON}}</strong>
                                        </span>
										<span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
                                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 0.5L10.5 10" stroke="black"/>
                                                <path d="M1 10L10.5 0.5" stroke="black"/>
                                            </svg>
                                        </span>
									</div>
									{{/COUPON_LIST}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?
    }
    ?>
	<div class="basket-checkout-container" data-entity="basket-checkout-aligner">
		<div class="basket-checkout-section">
			<div class="basket-checkout-section-inner">
				<div class="basket-checkout-block basket-checkout-block-total">
					<div class="basket-checkout-block-total-inner">
						<div class="basket-checkout-block-total-title"><?= Loc::getMessage('SBB_TOTAL') ?>:</div>
						<div class="basket-checkout-block-total-description">
							{{#SHOW_VAT}}
                            <?= Loc::getMessage('SBB_VAT') ?>: {{{VAT_SUM_FORMATED}}}
							{{/SHOW_VAT}}
						</div>
					</div>
				</div>
				
				<div class="basket-checkout-block basket-checkout-block-total-price">
					<div class="basket-checkout-block-total-price-inner">
						{{#DISCOUNT_PRICE_FORMATED}}
						<div class="basket-coupon-block-total-price-old">
							{{{PRICE_WITHOUT_DISCOUNT_FORMATED}}}
						</div>
						{{/DISCOUNT_PRICE_FORMATED}}
						
						<div class="basket-coupon-block-total-price-current" data-entity="basket-total-price">
							{{{PRICE_FORMATED}}}
						</div>
						
						{{#DISCOUNT_PRICE_FORMATED}}
						<div class="basket-coupon-block-total-price-difference">
                            <?= Loc::getMessage('SBB_BASKET_ITEM_ECONOMY') ?>
							<span style="white-space: nowrap;">{{{DISCOUNT_PRICE_FORMATED}}}</span>
						</div>
						{{/DISCOUNT_PRICE_FORMATED}}
					</div>
				</div>
				
				<div class="basket-checkout-block basket-checkout-block-btn">
					<button class="btn btn-lg btn-default basket-btn-checkout{{#DISABLE_CHECKOUT}} disabled{{/DISABLE_CHECKOUT}}"
					        data-entity="basket-checkout-button">
                        <?= Loc::getMessage('SBB_ORDER') ?>
					</button>
				</div>
			</div>
		</div>
	</div>
</script>
