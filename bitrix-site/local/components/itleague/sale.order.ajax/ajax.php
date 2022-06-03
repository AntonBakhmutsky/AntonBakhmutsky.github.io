<?php

use Bitrix\Main\Security\Sign\BadSignatureException;
use Bitrix\Main\Security\Sign\Signer;
use Bitrix\Main\Web\PostDecodeFilter;

const STOP_STATISTICS = true;
const NO_KEEP_STATISTIC = 'Y';
const NO_AGENT_STATISTIC = 'Y';
const DisableEventsCheck = true;
const BX_SECURITY_SHOW_MESSAGE = true;
const NOT_CHECK_PERMISSIONS = true;

$siteId = isset($_REQUEST['SITE_ID']) && is_string($_REQUEST['SITE_ID']) ? $_REQUEST['SITE_ID'] : '';
$siteId = mb_substr(preg_replace('/[^a-z0-9_]/i', '', $siteId), 0, 2);
if (! empty($siteId) && is_string($siteId)) {
    define('SITE_ID', $siteId);
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$request->addFilter(new PostDecodeFilter);

if (! Bitrix\Main\Loader::includeModule('sale')) {
    return;
}

Bitrix\Main\Localization\Loc::loadMessages(dirname(__FILE__) . '/class.php');

$signer = new Signer;
try {
    $signedParamsString = $request->get('signedParamsString') ?: '';
    $params = $signer->unsign($signedParamsString, 'sale.order.ajax');
    $params = unserialize(base64_decode($params), ['allowed_classes' => false]);
} catch (BadSignatureException $e) {
    die();
}

$action = $request->get($params['ACTION_VARIABLE']);
if (empty($action)) {
    return;
}

app()->IncludeComponent(
    'itleague:sale.order.ajax',
    '',
    $params
);
