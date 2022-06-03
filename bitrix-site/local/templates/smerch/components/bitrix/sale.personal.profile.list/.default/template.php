<?php


/** @var array $arParams */

/** @var array $arResult */

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

?>
	
	<h2 class="pa__header">Мои адреса</h2>

<?php

if ((int)Bitrix\Main\Context::getCurrent()->getRequest()->getQuery('success_del_id') > 0) {
    ShowNote($arResult["ERROR_MESSAGE"]);
} else {
    ShowError($arResult["ERROR_MESSAGE"]);
}

if (count($arResult["PROFILES"]) === 0) { ?>
	
	<div class="pa__address">
		<div class="pa__address-empty">У вас ещё нет адресов доставки.</div>
	</div>
    <?php
} else { ?>
	
	<div class="pa__address" id="<?= ($containerId = $this->GetEditAreaId('profiles')) ?>">
        <?php
        if (is_array($arResult["PROFILES"]) && ! empty($arResult["PROFILES"])) {
        foreach ($arResult["PROFILES"] as $profile) { ?>
			<div class="pa__address-item">
				<div class="pa__address-item-name"><?= $profile["NAME"] ?></div>
				<div class="pa__address-item-place"><?= $profile['ADDRESS'] ?></div>
				<div class="pa__address-item-btns">
					<a class="pa__address-item-edit" href="<?= $profile["URL_TO_DETAIL"] ?>">
						Изменить<img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/pa/pencil.svg" alt="edit">
					</a>
					<button class="pa__address-item-delete" data-url-to-delete="<?= $profile["URL_TO_DETELE"] ?>">
						Удалить<img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/pa/garbage.svg" alt="delete">
					</button>
				</div>
			</div>
        
        
        <?php
        }
        
        echo $arResult["NAV_STRING"]; ?>
			
			<script type="text/javascript">
				BX.ready(function () {
					BX.SalePersonalProfileListComponent.create('<?=$containerId?>');
				});
			</script>
            <?php
        }
        ?>
	</div>
    <?php
}
