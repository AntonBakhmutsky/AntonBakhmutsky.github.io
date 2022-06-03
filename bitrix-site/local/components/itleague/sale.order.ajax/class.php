<?php

use Bitrix\Main\Context;
use Bitrix\Main\Web\Cookie;
use Bitrix\Sale\Internals\UserPropsTable;
use Bitrix\Sale\Order;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

CBitrixComponent::includeComponentClass("bitrix:sale.order.ajax");

class ItLeagueSaleOrderAjax extends SaleOrderAjax
{
    public function onPrepareComponentParams($arParams): array
    {
        $arParams = parent::onPrepareComponentParams($arParams);
        
        $context = Context::getCurrent();
        $request = $context->getRequest();
        $skipRegistration = $request->getCookie("skip_registration") === 'yes' || $request->getQuery('skip_registration') === 'yes';
        
        if ($skipRegistration) {
            $cookie = new Cookie("skip_registration", "yes", time() + 86400 * 30);
            $cookie->setSpread(Cookie::SPREAD_DOMAIN);
            $cookie->setDomain($context->getServer()->getHttpHost());
            $cookie->setPath(SITE_DIR);
            $cookie->setSecure($request->isHttps());
            $cookie->setHttpOnly(false);
            $context->getResponse()->addCookie($cookie);
        }
    
        $arParams['ALLOW_AUTO_REGISTER'] = $skipRegistration ? 'Y' : $arParams['ALLOW_AUTO_REGISTER'];
        
        return $arParams;
    }
    
    protected function initUserProfiles(Order $order, $isPersonTypeChanged): void
    {
        $arResult =& $this->arResult;
        
        if ($this->arUserResult['PROFILE_CHANGE'] === false || $this->arUserResult['PROFILE_ID'] === false) {
            $this->arUserResult['PROFILE_ID'] = 0;
        }
        
        $dbUserProfiles = UserPropsTable::getList(
            [
                'filter' => [
                    '=PERSON_TYPE_ID' => $order->getPersonTypeId(),
                    '=USER_ID' => $order->getUserId()
                ],
                'order' => ['DATE_UPDATE' => 'DESC'],
                'select' => ['ID', 'NAME']
            ]
        );
        while ($arUserProfiles = $dbUserProfiles->fetch()) {
            if ((int)$this->arUserResult['PROFILE_ID'] === (int)$arUserProfiles['ID']) {
                $arUserProfiles['CHECKED'] = 'Y';
            }
            
            $arResult['ORDER_PROP']['USER_PROFILES'][$arUserProfiles['ID']] = $arUserProfiles;
        }
    }
}
