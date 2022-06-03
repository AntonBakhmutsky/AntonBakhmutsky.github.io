<?php

/** @var \CUser $USER */

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php";
$APPLICATION->SetPageProperty('NAV_FOOTER', 'Y');
$APPLICATION->SetPageProperty('BASKET_ICON_CLASS', 'active');
$APPLICATION->SetTitle('ОФОРМЛЕНИЕ ЗАКАЗА');

?>
	<section class="order">
		<div class="container container_bg">
            <?php
            $APPLICATION->IncludeComponent(
                "itleague:sale.order.ajax",
                "",
                [
                    "ACTION_VARIABLE" => "soa-action",
                    "ADDITIONAL_PICT_PROP_2" => "-",
                    "ADDITIONAL_PICT_PROP_3" => "-",
                    "ADDITIONAL_PICT_PROP_4" => "-",
                    "ADDITIONAL_PICT_PROP_5" => "-",
                    "ALLOW_APPEND_ORDER" => "Y",
                    "ALLOW_AUTO_REGISTER" => 'N',
                    "ALLOW_NEW_PROFILE" => "Y",
                    "ALLOW_USER_PROFILES" => "Y",
                    "BASKET_IMAGES_SCALING" => "adaptive",
                    "BASKET_POSITION" => "after",
                    "COMPATIBLE_MODE" => "N",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "DELIVERIES_PER_PAGE" => "9",
                    "DELIVERY_FADE_EXTRA_SERVICES" => "N",
                    "DELIVERY_NO_AJAX" => "N",
                    "DELIVERY_NO_SESSION" => "Y",
                    "DELIVERY_TO_PAYSYSTEM" => "d2p",
                    "DISABLE_BASKET_REDIRECT" => "N",
                    "EMPTY_BASKET_HINT_PATH" => "/",
                    "HIDE_ORDER_DESCRIPTION" => "Y",
                    "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
                    "PATH_TO_AUTH" => "/personal/",
                    "PATH_TO_BASKET" => "/personal/cart/",
                    "PATH_TO_PAYMENT" => "/personal/order/payment/",
                    "PATH_TO_PERSONAL" => "/personal/",
                    "PAY_FROM_ACCOUNT" => "N",
                    "PAY_SYSTEMS_PER_PAGE" => "9",
                    "PICKUPS_PER_PAGE" => "5",
                    "PICKUP_MAP_TYPE" => "yandex",
                    "PRODUCT_COLUMNS_HIDDEN" => [],
                    "PRODUCT_COLUMNS_VISIBLE" => ["PREVIEW_PICTURE", "PROPS"],
                    "PROPS_FADE_LIST_1" => [7],
                    "SEND_NEW_USER_NOTIFY" => "N",
                    "SERVICES_IMAGES_SCALING" => "adaptive",
                    "SET_TITLE" => "N",
                    "SHOW_BASKET_HEADERS" => "N",
                    "SHOW_COUPONS" => "Y",
                    "SHOW_COUPONS_BASKET" => "Y",
                    "SHOW_COUPONS_DELIVERY" => "N",
                    "SHOW_COUPONS_PAY_SYSTEM" => "N",
                    "SHOW_DELIVERY_INFO_NAME" => "Y",
                    "SHOW_DELIVERY_LIST_NAMES" => "Y",
                    "SHOW_DELIVERY_PARENT_NAMES" => "Y",
                    "SHOW_MAP_IN_PROPS" => "N",
                    "SHOW_NEAREST_PICKUP" => "Y",
                    "SHOW_NOT_CALCULATED_DELIVERIES" => "L",
                    "SHOW_ORDER_BUTTON" => "final_step",
                    "SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
                    "SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
                    "SHOW_PICKUP_MAP" => "Y",
                    "SHOW_STORES_IMAGES" => "Y",
                    "SHOW_TOTAL_ORDER_BUTTON" => "N",
                    "SHOW_VAT_PRICE" => "Y",
                    "SKIP_USELESS_BLOCK" => "N",
                    "SPOT_LOCATION_BY_GEOIP" => "N",
                    "TEMPLATE_LOCATION" => "popup",
                    "TEMPLATE_THEME" => "blue",
                    "USER_CONSENT" => $USER->IsAuthorized() ? 'N' : 'Y',
                    "USER_CONSENT_ID" => "1",
                    "USER_CONSENT_IS_CHECKED" => "N",
                    "USER_CONSENT_IS_LOADED" => "N",
                    "USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
                    "USE_CUSTOM_ERROR_MESSAGES" => "N",
                    "USE_CUSTOM_MAIN_MESSAGES" => "N",
                    "USE_ENHANCED_ECOMMERCE" => "N",
                    "USE_PHONE_NORMALIZATION" => "Y",
                    "USE_PRELOAD" => "N",
                    "USE_PREPAYMENT" => "N",
                    "USE_YM_GOALS" => "N"
                ]
            ); ?>
		</div>
	</section>
<?php
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";
