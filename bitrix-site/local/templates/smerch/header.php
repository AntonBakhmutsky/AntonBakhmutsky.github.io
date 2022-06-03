<?php


use Bitrix\Main\Page\Asset;
use ITLeague\Helpers\Color;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
Color::set('#8C8888');
?>

<!doctype html>
<html lang="ru" <?php
app()->ShowProperty('COLOR') ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/assets/favicon.ico">
	<title><?php
        app()->ShowTitle() ?></title>
    <?php
    ! in_dir(SITE_DIR) && Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/scripts/main.js') ?>
    <?php
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/styles/app.css') ?>
    
    <?php
    app()->ShowHead() ?>
</head>
<body>
<?php
app()->ShowPanel() ?>

<header class="header header_<?php
app()->ShowProperty('CLASS') ?>">
    <?php
    if (in_dir(SITE_DIR) || (defined('ERROR_404') && ERROR_404 === 'Y')) { ?>
		
		<div class="header__main-logo"></div>
        
        <?php
    } else { ?>
		
		<div class="header__inner">
			<a class="header__logo" href="<?= SITE_DIR ?>">
                <?php
                app()->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    [
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_DIR . "include/logo.php"
                    ]
                ) ?>
			</a>
            <?php
            app()->IncludeComponent(
                "bitrix:menu",
                "top",
                [
                    "ROOT_MENU_TYPE" => "top",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "",
                    "USE_EXT" => "N",
                    "DELAY" => "Y",
                    "ALLOW_MULTI_SELECT" => "N",
                    "MENU_CACHE_TYPE" => "AUTO",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => ""
                ]
            );
            app()->IncludeComponent(
                "bitrix:sale.basket.basket.line",
                "",
                [
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "HIDE_ON_BASKET_PAGES" => "N",
                    "PATH_TO_AUTHORIZE" => SITE_DIR . "login/",
                    "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
                    "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
                    "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                    "PATH_TO_PROFILE" => SITE_DIR . "personal/",
                    "PATH_TO_REGISTER" => SITE_DIR . "login/",
                    "POSITION_FIXED" => "N",
                    "SHOW_AUTHOR" => "Y",
                    "SHOW_EMPTY_VALUES" => "N",
                    "SHOW_NUM_PRODUCTS" => "Y",
                    "SHOW_PERSONAL_LINK" => "Y",
                    "SHOW_PRODUCTS" => "N",
                    "SHOW_REGISTRATION" => "Y",
                    "SHOW_TOTAL_PRICE" => "N"
                ]
            ) ?>
			<div class="header__mobile-nav"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/header/mobile-nav.svg" alt=""></div>
		</div>
        <?php
    } ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(86015825, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/86015825" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</header>

<main class="main main_<?php
app()->ShowProperty('CLASS') ?>">

