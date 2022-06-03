<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}


/** @var CBitrixComponentTemplate $this */
/** @var \HomepageComponent $component */
/** @var array $arResult */

$iblocks = $arResult['ITEMS'];
?>

<div class="container">
    <?php
    if (count($iblocks) > 0) { ?>
		<nav class="main-nav">
            <?php
            foreach ($iblocks as $iblock) {
                $buttons = CIBlock::GetPanelButtons($iblock['ID']);
                $this->AddEditAction($iblock['ID'], $buttons['submenu']['edit_iblock']['ACTION_URL'] . '&bxpublic=Y&from_module=iblock'); ?>
				
				<div class="main-nav__item main-nav__item_<?= $iblock['CODE'] === 'poshtuchno' ? 'apiece' : $iblock['CODE'] ?>"
				     id="<?= $this->GetEditAreaId($iblock['ID']) ?>">
					<a href="<?= $iblock['LIST_PAGE_URL'] ?>"><?= $iblock['NAME'] ?></a>
				</div>
                <?php
            } ?>
		</nav>
        <?php
    } ?>
</div>
