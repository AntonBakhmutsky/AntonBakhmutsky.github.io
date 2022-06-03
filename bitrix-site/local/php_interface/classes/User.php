<?php


namespace ITLeague;


use Bitrix\Main\Context;
use Bitrix\Main\UserConsent\Agreement;
use Bitrix\Main\UserConsent\Consent;
use Bitrix\Main\UserTable;
use COption;

class User
{
    public static function onBeforeRegister(array &$fields): bool
    {
        // проверка согласия на обработку перс. данных при оформлении заказа и при регистрации
        $request = Context::getCurrent()->getRequest();
        $order = $request->get('order');
        if (($order && $order['USER_AGREEMENT'] !== 'Y') && $request->get('USER_AGREEMENT') !== 'Y') {
            app()->ThrowException('Необходимо согласие с политикой конфиденциальности и пользовательским соглашением.');
            return false;
        }
        
        $fields['LOGIN'] = $fields['EMAIL'];
        $fields['PERSONAL_PHONE'] = $fields['PHONE_NUMBER'];
        if (isset($fields['PERSONAL_PHOTO'])) {
            unset($fields['PERSONAL_PHOTO']);
        }
        
        return true;
    }
    
    public static function onAfterRegister(array &$fields): void
    {
        if ($fields["USER_ID"] > 0) {
            // сохранение согласия на обработку перс. данных при регистрации со страницы заказа
            $agreementId = intval(COption::getOptionString("main", "new_user_agreement"));
            $order = Context::getCurrent()->getRequest()->get('order');
            if ($agreementId) {
                $agreementObject = new Agreement($agreementId);
                if ($agreementObject->isExist() && $agreementObject->isActive() && $order && $order['USER_AGREEMENT'] === 'Y') {
                    Consent::addByContext($agreementId, "order/reg", "register");
                }
            }
        }
    }
    
    public static function onBeforeAddOrUpdate(array &$fields): void
    {
        $fields['LOGIN'] = $fields['EMAIL'];
        $fields['PHONE_NUMBER'] = $fields['PERSONAL_PHONE'];
        if (! isset($fields['PERSONAL_PHOTO']) || ! is_array($fields['PERSONAL_PHOTO'])) {
            $fields['PERSONAL_PHOTO'] = ['del' => "Y"];
        } else {
            unset($fields['PERSONAL_PHOTO']);
        }
    }
    
    public static function onFindSocialservicesUser(array &$fields): int
    {
        if ($fields['EMAIL'] && $user = UserTable::getList(
                [
                    'filter' => [
                        '=EMAIL' => ToLower($fields['EMAIL']),
                        '=ACTIVE' => 'Y'
                    ],
                    'limit' => 1,
                    'select' => ["ID"],
                ]
            )->fetch()) {
            return (int)$user['ID'];
        }
        return 0;
    }
}
