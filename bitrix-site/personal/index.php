<?php

const NEED_AUTH = true;

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php";
$APPLICATION->SetPageProperty('NAV_FOOTER', 'Y');
$APPLICATION->SetPageProperty('PERSONAL_ICON_CLASS', 'active');
$APPLICATION->SetTitle("Личный кабинет");
?>

<section class="pa">
    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "personal",
        [
            "ROOT_MENU_TYPE" => "personal",
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "",
            "USE_EXT" => "N",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "N",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "N",
            "MENU_CACHE_GET_VARS" => ""
        ]
    ); ?>
	
	<div class="container container_bg">
        <?php
        $APPLICATION->IncludeComponent(
            "bitrix:sale.personal.section",
            "",
            [
                "ACCOUNT_PAYMENT_SELL_USER_INPUT" => "N",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CHECK_RIGHTS_PRIVATE" => "N",
                "COMPATIBLE_LOCATION_MODE_PROFILE" => "N",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "CUSTOM_PAGES" => "",
                "CUSTOM_SELECT_PROPS" => [""],
                "MAIN_CHAIN_NAME" => "Личный кабинет",
                "NAV_TEMPLATE" => "",
                "ORDERS_PER_PAGE" => "5",
                "ORDER_DEFAULT_SORT" => "STATUS",
                "ORDER_DISALLOW_CANCEL" => "N",
                "ORDER_HIDE_USER_INFO" => ["0"],
                "ORDER_HISTORIC_STATUSES" => ["F", "C"],
                "ORDER_REFRESH_PRICES" => "Y",
                "ORDER_RESTRICT_CHANGE_PAYSYSTEM" => ["0"],
                "PATH_TO_BASKET" => "/personal/cart/",
                "PATH_TO_CATALOG" => "/collabs/",
                "PATH_TO_CONTACT" => "/contacts/",
                "PATH_TO_PAYMENT" => "/personal/order/payment/",
                "PROFILES_PER_PAGE" => "10",
                "PROP_1" => [],
                "PROP_2" => [],
                "SAVE_IN_SESSION" => "Y",
                "SEF_FOLDER" => "/personal/",
                "SEF_MODE" => "Y",
                "SEF_URL_TEMPLATES" => [
                    "account" => "account/",
                    "index" => "index.php",
                    "order_cancel" => "cancel/#ID#",
                    "order_detail" => "orders/#ID#",
                    "orders" => "orders/",
                    "private" => "private/",
                    "profile" => "profiles/",
                    "profile_detail" => "profiles/#ID#",
                    "subscribe" => "subscribe/"
                ],
                "SEND_INFO_PRIVATE" => "N",
                "SET_TITLE" => "N",
                "SHOW_ACCOUNT_PAGE" => "N",
                "SHOW_BASKET_PAGE" => "N",
                "SHOW_CONTACT_PAGE" => "N",
                "SHOW_ORDER_PAGE" => "Y",
                "SHOW_PRIVATE_PAGE" => "Y",
                "SHOW_PROFILE_PAGE" => "Y",
                "SHOW_SUBSCRIBE_PAGE" => "N",
                "USE_AJAX_LOCATIONS_PROFILE" => "N"
            ]
        ); ?>
	</div>
</section>
<?php
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"; ?>
