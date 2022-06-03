<?php

use Bitrix\Main;
use Bitrix\Sale;
use Bitrix\Sale\Order;

const STOP_STATISTICS = true;
const NO_AGENT_CHECK = true;
const NOT_CHECK_PERMISSIONS = true;
const DisableEventsCheck = true;

require $_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php';

Main\Loader::includeModule('sale');
$request = Main\Application::getInstance()->getContext()->getRequest();

if ($request->get('SignatureValue')) {
    $redirectUrl = Main\Config\Option::get('sale', 'sale_ps_success_path', '/');

    $paymentId = (int) $request->get('InvId');
    if ($paymentId > 0) {
        $order = Order::load(Sale\Internals\PaymentTable::getByPrimary($paymentId, ['select' => ['ORDER_ID']])->fetchObject()->getOrderId());

        $onlyCert = true;
        foreach ($order->getBasket()->getBasketItems() as $basketItem) {
            if (!array_key_exists("COUPON_1", $basketItem->getPropertyCollection()->getPropertyValues())) {
                $onlyCert = false;
                break;
            }
        }
        if ($onlyCert) {
            $uri = new Main\Web\Uri($redirectUrl);
            $uri->addParams(['gift' => 'yes']);
            $redirectUrl = $uri->getUri();
        }
    }
} else {
    $redirectUrl = Main\Config\Option::get('sale', 'sale_ps_fail_path', '/');
}

$shpRedirectUrl = $request->get('SHP_BX_REDIRECT_URL');
if (!$shpRedirectUrl) {

    $debugInfo = http_build_query($request->toArray(), '', "\n");
    if (empty($debugInfo)) {
        $debugInfo = file_get_contents('php://input');
    }

    Sale\PaySystem\Logger::addDebugInfo('Robokassa redirect request: '.($debugInfo ?: 'empty'));
}

LocalRedirect($redirectUrl);
