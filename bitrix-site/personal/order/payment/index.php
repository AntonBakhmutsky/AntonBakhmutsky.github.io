<?php

/** @var \CUser $USER */

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
$APPLICATION->SetTitle("ОПЛАТА ЗАКАЗА");
$APPLICATION->IncludeComponent(
    "bitrix:sale.order.payment",
    "",
    [
    ]
);
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php";
