<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty('CLASS', 'static');
$APPLICATION->SetPageProperty('NAV_FOOTER', 'Y');
$APPLICATION->SetTitle("Доставка и оплата");
?>

<div class="container">
	<div class="static">
        <?php
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            [
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_DIR . "include/delivery.php"
            ]
        ) ?>
	</div>
	<div class="static">
        <?php
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            [
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_DIR . "include/payment.php"
            ]
        ) ?>
	</div>
</div>

<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
