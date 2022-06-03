<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Security\Sign\BadSignatureException;
use Bitrix\Main\Security\Sign\Signer;
use Bitrix\Main\Web\PostDecodeFilter;

const STOP_STATISTICS = true;
const NOT_CHECK_PERMISSIONS = true;

$siteId = isset($_REQUEST['siteId']) && is_string($_REQUEST['siteId']) ? $_REQUEST['siteId'] : '';
$siteId = mb_substr(preg_replace('/[^a-z0-9_]/i', '', $siteId), 0, 2);
if (! empty($siteId) && is_string($siteId)) {
    define('SITE_ID', $siteId);
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = Application::getInstance()->getContext()->getRequest();
$request->addFilter(new PostDecodeFilter);

if (! Loader::includeModule('iblock')) {
    return;
}

$signer = new Signer;
try {
    $template = $signer->unsign($request->get('template') ?: '', 'catalog.section') ?: '.default';
    $paramString = $signer->unsign($request->get('parameters') ?: '', 'catalog.section');
} catch (BadSignatureException $e) {
    die();
}

$parameters = unserialize(base64_decode($paramString), ['allowed_classes' => false]);
if (isset($parameters['PARENT_NAME'])) {
    $parent = new CBitrixComponent();
    $parent->InitComponent($parameters['PARENT_NAME'], $parameters['PARENT_TEMPLATE_NAME']);
    $parent->InitComponentTemplate($parameters['PARENT_TEMPLATE_PAGE']);
} else {
    $parent = false;
}

app()->IncludeComponent(
    'itleague:catalog.section',
    $template,
    $parameters,
    $parent
);
