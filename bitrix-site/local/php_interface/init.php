<?php

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Context;
use Bitrix\Main\EventManager;
use Bitrix\Main\EventResult;
use Bitrix\Main\UI\Extension;
use ITLeague\DeliveryRestriction;
use ITLeague\Iblock\Section;
use ITLeague\Order;
use ITLeague\Socials\SocialServices;
use ITLeague\User;

require_once __DIR__ . '/../../bitrix/vendor/autoload.php';

if (file_exists($smpt_filename = __DIR__ . '/../../bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php')) {
    include_once $smpt_filename;
}

if (!function_exists('in_dir')) {
    function in_dir(string $dir): bool
    {
        $request = Context::getCurrent()->getRequest();
        return rtrim($request->getRequestedPageDirectory(), '/') === rtrim($dir, '/');
    }
}

if (!function_exists('app')) {
    function app(): CMain
    {
        global $APPLICATION;
        return $APPLICATION;
    }
}

if (!function_exists('iblock_code')) {
    function iblock_code(int $iblockId): string
    {
        return IblockTable::query()
            ->setFilter(['=ID' => $iblockId])
            ->setLimit(1)
            ->setSelect(['CODE'])
            ->setCacheTtl(24 * 3600)
            ->fetchObject()->getCode();
    }
}

Extension::registerAssets(
    'itl_popup',
    [
        'js' => ['/local/templates/smerch/scripts/popup.js'],
        'rel' => ['popup']
    ]
);

$eventManager = EventManager::getInstance();

$eventManager->addEventHandler('iblock', 'OnAfterIBlockSectionAdd', [Section::class, 'onAfterAdd']);
$eventManager->addEventHandler('iblock', 'OnBeforeIBlockSectionUpdate', [Section::class, 'onBeforeUpdate']);
$eventManager->addEventHandler('iblock', 'OnAfterIBlockSectionUpdate', [Section::class, 'onAfterUpdate']);
$eventManager->addEventHandler('iblock', 'OnAfterIBlockSectionDelete', [Section::class, 'onAfterDelete']);

$eventManager->addEventHandler("main", "OnBeforeUserUpdate", [User::class, 'onBeforeAddOrUpdate']);
$eventManager->addEventHandler("main", "OnBeforeUserAdd", [User::class, 'onBeforeAddOrUpdate']);
$eventManager->addEventHandler("main", "OnBeforeUserRegister", [User::class, 'onBeforeRegister']);
$eventManager->addEventHandler("main", "OnAfterUserRegister", [User::class, 'onAfterRegister']);
$eventManager->addEventHandler('socialservices', 'OnFindSocialservicesUser', [User::class, 'onFindSocialservicesUser']);
$eventManager->addEventHandler('socialservices', 'OnAuthServicesBuildList', [SocialServices::class, 'onAuthServicesBuildList'], false, 200);

$eventManager->addEventHandler("sale", "OnSaleBeforeOrderCanceled", [Order::class, 'onBeforeCanceled']);
$eventManager->addEventHandler("sale", "OnSaleOrderBeforeSaved", [Order::class, 'onBeforeSaved']);
$eventManager->addEventHandler("sale", "OnSaleOrderSaved", [Order::class, 'onAfterSaved']);
$eventManager->addEventHandler("sale", "OnOrderPaySendEmail", [Order::class, 'onPaySendEmail']);
$eventManager->addEventHandler("sale", "OnSaleOrderPaid", [Order::class, 'onPaid']);
$eventManager->addEventHandler("main", "OnBeforeEventAdd", [Order::class, 'onSelectMessageIdForEmail']);
$eventManager->addEventHandler(
    'sale',
    'onSaleDeliveryRestrictionsClassNamesBuildList',
    [DeliveryRestriction::class, 'onSaleDeliveryRestrictionsClassNamesBuildList']
);