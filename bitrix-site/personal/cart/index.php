<?php

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php";
$APPLICATION->SetPageProperty('NAV_FOOTER', 'Y');
$APPLICATION->SetPageProperty('BASKET_ICON_CLASS', 'active');
$APPLICATION->SetTitle("МОЯ КОРЗИНА");
?>
	
	<section class="basket">
		<div class="container container_bg">
            <?$APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket",
                "",
                [
                    "ACTION_VARIABLE" => "basketAction",
                    "ADDITIONAL_PICT_PROP_2" => "-",
                    "ADDITIONAL_PICT_PROP_3" => "-",
                    "ADDITIONAL_PICT_PROP_4" => "-",
                    "ADDITIONAL_PICT_PROP_5" => "-",
                    "AUTO_CALCULATION" => "Y",
                    "BASKET_IMAGES_SCALING" => "adaptive",
                    "COLUMNS_LIST_EXT" => ["PREVIEW_PICTURE", "DELETE", "SUM"],
                    "COLUMNS_LIST_MOBILE" => ["PREVIEW_PICTURE", "DELETE", "SUM"],
                    "COMPATIBLE_MODE" => "N",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "CORRECT_RATIO" => "Y",
                    "DEFERRED_REFRESH" => "N",
                    "DISCOUNT_PERCENT_POSITION" => "top-right",
                    "DISPLAY_MODE" => "extended",
                    "EMPTY_BASKET_HINT_PATH" => "/",
                    "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
                    "GIFTS_CONVERT_CURRENCY" => "N",
                    "GIFTS_HIDE_BLOCK_TITLE" => "N",
                    "GIFTS_HIDE_NOT_AVAILABLE" => "N",
                    "GIFTS_MESS_BTN_BUY" => "Выбрать",
                    "GIFTS_MESS_BTN_DETAIL" => "Подробнее",
                    "GIFTS_PAGE_ELEMENT_COUNT" => "4",
                    "GIFTS_PLACE" => "BOTTOM",
                    "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
                    "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
                    "GIFTS_SHOW_OLD_PRICE" => "N",
                    "GIFTS_TEXT_LABEL_GIFT" => "Подарок",
                    "HIDE_COUPON" => "N",
                    "LABEL_PROP" => [],
                    "LABEL_PROP_MOBILE" => ["SIZE"],
                    "LABEL_PROP_POSITION" => "top-left",
                    "PATH_TO_ORDER" => "/personal/order/make/",
                    "PRICE_DISPLAY_MODE" => "Y",
                    "PRICE_VAT_SHOW_VALUE" => "N",
                    "PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
                    "QUANTITY_FLOAT" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_DISCOUNT_PERCENT" => "Y",
                    "SHOW_FILTER" => "N",
                    "SHOW_RESTORE" => "N",
                    "TEMPLATE_THEME" => "blue",
                    "TOTAL_BLOCK_DISPLAY" => ["bottom"],
                    "USE_DYNAMIC_SCROLL" => "Y",
                    "USE_ENHANCED_ECOMMERCE" => "N",
                    "USE_GIFTS" => "N",
                    "USE_PREPAYMENT" => "N",
                    "USE_PRICE_ANIMATION" => "Y"
                ]
            ) ?>
		</div>
	</section>

<?php
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";
