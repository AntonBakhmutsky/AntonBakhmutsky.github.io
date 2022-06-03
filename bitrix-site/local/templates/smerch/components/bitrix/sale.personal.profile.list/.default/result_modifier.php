<?php


/** @var \CUser $USER */

/** @var array $arParams */

/** @var array $arResult */

use Bitrix\Sale\Internals\OrderPropsTable;
use Bitrix\Sale\Location\Admin\LocationHelper;
use Bitrix\Sale\OrderUserProperties;

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$properties = OrderPropsTable::getList(
    [
        'filter' => [
            '=PERSON_TYPE_ID' => 1,
            '=PROPS_GROUP_ID' => 1,
            '=USER_PROPS' => true,
            '=ACTIVE' => true,
            '=UTIL' => false
        ],
        'order' => ['SORT' => 'ASC'],
        'select' => ['ID', 'CODE']
    ]
)->fetchAll();

foreach ($arResult['PROFILES'] as &$profile) {
    $profileData = OrderUserProperties::getProfileValues((int)($profile['ID']));
    $address = [];
    foreach ($properties as $property) {
        switch ($property['CODE']) {
            case 'STREET':
                $val = 'ул. ' . $profileData[$property['ID']];
                break;
            case 'HOUSE':
                $val = 'д. ' . $profileData[$property['ID']];
                break;
            case 'FLAT':
                $val = 'кв. ' . $profileData[$property['ID']];
                break;
            case 'LOCATION':
                $val = LocationHelper::getLocationStringByCode($profileData[$property['ID']]);
                break;
        }
        if ($profileData[$property['ID']]) {
            $address[] = $val;
        }
    }
    $profile['ADDRESS'] = implode(', ', $address);
}
