<?php

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"; ?>
	
	<div class="container container_sm">
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
                "PATH" => SITE_DIR . "include/tips/merch_top.php"
            ]
        ) ?>
	</div>

<?php
$APPLICATION->IncludeComponent(
    'itleague:merch.list.component',
    '',
    [
        'CACHE_TIME' => 600,
        "COMPOSITE_FRAME_MODE" => "Y",
        "COMPOSITE_FRAME_TYPE" => "STATIC",
    ]
) ?>
	
	<div class="container container_bg">
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
                "PATH" => SITE_DIR . "include/tips/merch_bottom.php"
            ]
        ) ?>
	</div>
<?php
$APPLICATION->IncludeComponent(
    'itleague:faq.component',
    '',
    [
        'CACHE_TIME' => 360000,
        'SECTION' => 'merch',
        "COMPOSITE_FRAME_MODE" => "Y",
        "COMPOSITE_FRAME_TYPE" => "STATIC",
    ]
);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";
