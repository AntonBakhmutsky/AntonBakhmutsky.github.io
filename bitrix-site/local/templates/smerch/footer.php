<?php


if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
	
	</main>

<?php
if (in_dir(SITE_DIR) || (defined('ERROR_404') && ERROR_404 === 'Y')) { ?>
	
	<footer class="footer__main">
		<div class="footer__copyright">
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
	</footer>
    <?php
} elseif (app()->GetPageProperty('NAV_FOOTER') === 'Y') { ?>
	<footer class="footer__nav">
        <?php
        app()->IncludeComponent(
            "bitrix:menu",
            "bottom",
            [
                "ROOT_MENU_TYPE" => "bottom",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N",
                "MENU_CACHE_TYPE" => "AUTO",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "N",
                "MENU_CACHE_GET_VARS" => ""
            ]
        ); ?>
	</footer>
    <?php
} else { ?>
	<footer class="footer__second">
		<div class="container">
			<div class="footer__copyright">
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
		</div>
	</footer>
    <?php
} ?>
	</body>
	</html>

<?php
app()->SetTitle(ToUpper(app()->GetTitle()));
