<?php


/** @var array $arParams */

/** @var array $arResult */

/** @var \CBitrixComponent $component */

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use ITLeague\Socials\SocialServices;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if ($arResult['ERROR_MESSAGE']) {
    ShowMessage($arResult['ERROR_MESSAGE']);
}

$arServices = $arResult["AUTH_SERVICES_ICONS"];

?>
	<div class="pa__data-subtitle">Вы можете связать свой профиль с профилями в социальных сетях и сервисах:</div>

<?php
if (isset($arResult["DB_SOCSERV_USER"]) && $arParams["SHOW_PROFILES"] !== 'N') {
    ?>
	
	<div class="pa__data-socials" id="<?= ($containerId = $this->GetEditAreaId('socials')) ?>">
        
        <?php
        foreach ($arResult["DB_SOCSERV_USER"] as $key => $arUser) {
            if (! $icon = htmlspecialcharsbx($arResult["AUTH_SERVICES_ICONS"][$arUser["EXTERNAL_AUTH_ID"]]["ICON"])) {
                $icon = 'facebook';
            }
            $path = Application::getDocumentRoot() . SITE_TEMPLATE_PATH . "/assets/img/global/$icon.svg";
            if (! File::isFileExists($path)) {
                $path = SocialServices::getDefaultIconPath();
            }
            $authID = ($arServices[$arUser["EXTERNAL_AUTH_ID"]]["NAME"]) ?: $arUser["EXTERNAL_AUTH_ID"];
            ?>
			<div class="pa__data-socials-container active">
				
				<a class="pa__data-socials-link" <?= $arUser["PERSONAL_LINK"] !== '' ? "href=\"{$arUser["PERSONAL_LINK"]}\"" : '' ?>>
                    <?= File::getFileContents($path) ?>
				</a>
				<div class="pa__data-socials-user">
					<div class="pa__data-socials-user-network"><?= $authID ?></div>
					<div class="pa__data-socials-user-name"><?= $arUser["VIEW_NAME"] ?></div>
				</div>
                
                <?php
                if (in_array($arUser["ID"], $arResult["ALLOW_DELETE_ID"])) { ?>
					<a class="pa__data-socials-cancel" href="<?= htmlspecialcharsbx($arUser["DELETE_LINK"]) ?>" title="Удалить">
						<svg width="13" height="13" viewBox="0 0 13 13" fill="none"
						     xmlns="http://www.w3.org/2000/svg">
							<path d="M0.999023 1.00195C1.54902 1.55195 8.56152 8.56445 11.999 12.002"
							      stroke="black"></path>
							<path d="M1 12.002C1.55 11.452 8.5625 4.43945 12 1.00195" stroke="black"></path>
						</svg>
					</a>
                    <?php
                } ?>
			</div>
            <?php
        } ?>
	</div>
	<script type="text/javascript">
		BX.ready(function () {
			BX.SocservAuthSplitComponent.create('<?=$containerId?>');
		});
	</script>
    <?php
} ?>

<?php
app()->IncludeComponent(
    "bitrix:socserv.auth.form",
    "private",
    [
        "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
        "CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
        "AUTH_URL" => $arResult['CURRENTURL'],
        "POST" => $arResult["POST"],
        "SHOW_TITLES" => 'N',
        "FOR_SPLIT" => 'Y',
        "AUTH_LINE" => 'N',
    ],
    $component,
    ["HIDE_ICONS" => "Y"]
);



