<?php

use Bitrix\Main\Context;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty('NAV_FOOTER', 'Y');
$APPLICATION->SetTitle("КАК ВЫБРАТЬ РАЗМЕР?");

$APPLICATION->IncludeComponent(
    'itleague:sizes.component',
    '',
    [
        'CACHE_TIME' => 360000,
        "COMPOSITE_FRAME_MODE" => "Y",
        "CODE" => Context::getCurrent()->getRequest()->getQuery('code'),
        "COMPOSITE_FRAME_TYPE" => "STATIC",
    ]
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
