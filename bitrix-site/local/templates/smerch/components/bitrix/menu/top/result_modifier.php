<?php

if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CBitrixComponentTemplate $this
 * @var \CMenu $component
 */

$component = $this->getComponent();
sortByColumn($component->arResult, 'ITEM_INDEX');
