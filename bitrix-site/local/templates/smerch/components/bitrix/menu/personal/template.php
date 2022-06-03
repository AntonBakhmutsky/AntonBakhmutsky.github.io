<?php


/** @var array $arParams */

/** @var array $arResult */

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if (! empty($arResult)) { ?>
	<div class="pa__menu">
		<div class="pa__menu-overlay"></div>
		<div class="pa__menu-container">
            <?php
            foreach ($arResult as $item) { ?>
				<a <?= $item["SELECTED"] ? 'class="active"' : '' ?> href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a>
                <?php
            } ?>
		</div>
	</div>
    <?php
}
