<?php

/** @var CMain $APPLICATION */
include_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php';

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php";
$APPLICATION->SetPageProperty('CLASS', 'main-page');

$APPLICATION->SetTitle("404 Not Found"); ?>

<div class="page-404">
	<div class="container">
		<div class="page-404__image"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/404/404.svg" alt="404"></div>
		<div class="page-404__text">Ой, такой страницы нет :(</div>
		<a class="page-404__link" href="<?= SITE_DIR ?>">На главную</a></div>
</div>

<?php
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";
