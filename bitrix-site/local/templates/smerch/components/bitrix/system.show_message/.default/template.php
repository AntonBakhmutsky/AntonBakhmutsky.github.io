<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

$text = preg_split("/ *<br *\/*> */", $arParams["MESSAGE"]);
?>

<div class="container container_md">
	<div class="message">
        <?php
        foreach ($text as $item) {
            if ($item) { ?>
				<div class="message__item-text message__item-text_<?= $arParams["STYLE"] === 'notetext' ? 'success' : 'error' ?>">
                    <?= $item ?>
				</div>
                <?php
            }
        } ?>
	</div>
</div>
