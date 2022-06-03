<?php

const STOP_STATISTICS = true;
const NOT_CHECK_PERMISSIONS = true;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$request = Bitrix\Main\Context::getCurrent()->getRequest();

if ($request->isPost() && check_bitrix_sessid() && ! is_null($request->getPost('siteId')) &&
    ctype_alnum($request->getPost('siteId')) && strlen($request->getPost('siteId')) == 2) {
    $path = realpath(dirname(__FILE__));
    require_once "$path/../../class.php";
    
    $cart = new SaleBasketLineComponent();
    $cart->initComponent('bitrix:sale.basket.basket.line');
    $cart->includeComponentLang();
    
    $lang = LangSubst(LANGUAGE_ID);
    __IncludeLang("$path/lang/$lang/template.php");
    
    app()->RestartBuffer();
    header('Content-Type: text/html; charset=' . LANG_CHARSET);
    $cart->executeAjax($request->getPost('siteId'));
    
    die();
}
