<?php


/** @var \CUser $USER */

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Sale\Internals\StatusTable;

$arResult['STATUSES'] = [];
$statuses = StatusTable::getList(
    [
        'filter' => ['=ID' => ['P', 'K', 'D', 'F']],
        'select' => ['*', 'STATUS_LANG.*'],
        'order' => ['SORT' => 'asc']
    ]
)->fetchCollection();
$active = ! in_array($arResult['STATUS']['ID'], ['C', 'N']);
foreach ($statuses as $status) {
    if ($status->getId() === 'F' && $arResult['STATUS']['ID'] === 'F') {
        $statusName = $statusDescription = str_replace(
            '#DATE#',
            '<span>' . $arResult['DATE_STATUS_FORMATED'] . '</span>',
            $status->getStatusLang()->getDescription()
        );
    } else {
        $statusName = $status->getStatusLang()->getName();
        $statusDescription = $status->getStatusLang()->getDescription();
    }
    $arResult['STATUSES'][] = [
        'ID' => $status->getId(),
        'NAME' => $statusName,
        'DESCRIPTION' => $statusDescription,
        'ACTIVE' => $active
    ];
    $active = $active && $arResult['STATUS']['ID'] !== $status->getId();
}
