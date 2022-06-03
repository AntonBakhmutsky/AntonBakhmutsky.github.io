<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "sss23123123");
$APPLICATION->SetPageProperty('CLASS', 'static');
$APPLICATION->SetPageProperty('NAV_FOOTER', 'Y');
$APPLICATION->SetTitle("Контакты");
?><div class="container">
	<div class="static">
		 <?php $APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/contacts.php"
	)
);?>
	</div>
	<div class="static">
        <?php $APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/requisites.php"
	)
);?>
	</div>
</div>
<br><?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
