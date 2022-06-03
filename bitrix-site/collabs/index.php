<?php

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php";
$APPLICATION->SetPageProperty('NAV_FOOTER', 'Y');
$APPLICATION->SetPageProperty('CLASS', 'collabs');

$APPLICATION->IncludeComponent(
    'itleague:collabs.sections.component',
    '',
    [
        'CACHE_TIME' => 360000,
        'COLOR' => 'linear-gradient(90deg, #EAFA3A 38.02%, #9E17CA 67.19%)',
        "COMPOSITE_FRAME_MODE" => "Y",
        "COMPOSITE_FRAME_TYPE" => "STATIC",
    ]
);

$APPLICATION->IncludeComponent(
    'itleague:subscribe.form.component',
    '',
    [
        'RUBRIC' => 'collabs',
        "COMPOSITE_FRAME_MODE" => "Y",
        "COMPOSITE_FRAME_TYPE" => "STATIC",
    ]
);

$APPLICATION->IncludeComponent(
    'itleague:faq.component',
    '',
    [
        'CACHE_TIME' => 360000,
        'SECTION' => 'collabs',
        'SPOT' => SITE_TEMPLATE_PATH . '/assets/img/faq/gradient-spot.svg',
        "COMPOSITE_FRAME_MODE" => "Y",
        "COMPOSITE_FRAME_TYPE" => "STATIC",
    ]
);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";
