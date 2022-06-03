<?php


/** @var array $arParams */

/** @var array $arResult */

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if (! empty($arResult)) { ?>
	
	<nav class="footer__nav-container">
        <?php
        foreach ($arResult as $item) { ?>
			<div class="footer__nav-item"><a href="<?= $item["LINK"] ?>"><?= $item["TEXT"] ?></a></div>
            <?php
        } ?>
	</nav>
	<div class="footer__create">
        <?php
        app()->IncludeComponent(
            "bitrix:main.include",
            "",
            [
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_DIR . "include/author.php"
            ]
        ) ?>
	</div>
    
    <?php
}
