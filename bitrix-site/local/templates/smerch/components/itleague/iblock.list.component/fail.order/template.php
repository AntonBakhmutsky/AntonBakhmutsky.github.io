<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}


/** @var CBitrixComponentTemplate $this */
/** @var HomepageComponent $component */
/** @var array $arResult */

$iblocks = array_slice($arResult['ITEMS'], 1);

foreach ($iblocks as $iblock) { ?>
	<a href="<?= $iblock['LIST_PAGE_URL'] ?>">Посмотреть <?= $iblock['NAME'] ?></a>
    <?php
}
