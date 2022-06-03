<?php


/** @var array $arParams */

/** @var array $arResult */

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if (! empty($arResult)) { ?>
	
	<nav class="header__nav">
		<div class="header__nav-container">
            <?php
            foreach ($arResult as $item) { ?>
				<a
						href="<?= $item["LINK"] ?>"
						class="header__nav-link <?= $item["SELECTED"] ? 'active ' : '' ?><?= $item['PARAMS']['class'] ? 'header__nav-link_' . $item['PARAMS']['class'] : '' ?>"
				>
                    <?= $item["TEXT"] ?>
				</a>
                <?php
            } ?>
		</div>
		<div class="header__nav-close"></div>
		<div class="header__nav-copyright">
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
                    "PATH" => SITE_DIR . "include/copyright.php"
                ]
            ) ?>
		</div>
	</nav>
    
    <?php
}
