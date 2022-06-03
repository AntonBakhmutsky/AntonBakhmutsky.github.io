<?php

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Text\HtmlFilter;
use ITLeague\Socials\SocialServices;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$arAuthServices = $arPost = [];
if (is_array($arParams["~AUTH_SERVICES"])) {
    $arAuthServices = $arParams["~AUTH_SERVICES"];
}
if (is_array($arParams["~POST"])) {
    $arPost = $arParams["~POST"];
}

$hidden = "";
foreach ($arPost as $key => $value) {
    if (! preg_match("|OPENID_IDENTITY|", $key)) {
        $hidden .= '<input type="hidden" name="' . $key . '" value="' . $value . '" />' . "\n";
    }
}
?>


<div class="form__socials">
	<div class="form__container">
		<div class="form__title">Войти с помощью соцсетей</div>
		<div class="form__socials-links">
            
            <?php
            foreach ($arAuthServices as $service) {
                $path = Application::getDocumentRoot() . SITE_TEMPLATE_PATH . "/assets/img/global/{$service["ICON"]}.svg";
                if (! File::isFileExists($path)) {
                    $path = SocialServices::getDefaultIconPath();
                } ?>
				<a id="bx_socserv_icon_<?= $service["ID"] ?>" href="javascript:void(0)" onclick="<?= HtmlFilter::encode($service["ONCLICK"]) ?>"
				   title="<?= HtmlFilter::encode($service["NAME"]) ?>">
                    <?= File::getFileContents($path) ?>
				</a>
                <?php
                if ($service["ONCLICK"] == '' && $service["FORM_HTML"] <> '') { ?>
					<div id="bx_socserv_form_<?= $service["ID"] ?>" style="display: none">
						<form action="<?= $arParams["AUTH_URL"] ?>" method="post">
                            <?= $service["FORM_HTML"] ?>
                            <?= $hidden ?>
							<input type="hidden" name="auth_service_id" value="<?= $service["ID"] ?>"/>
						</form>
					</div>
                    <?php
                }
            } ?>
		</div>
	</div>
</div>
