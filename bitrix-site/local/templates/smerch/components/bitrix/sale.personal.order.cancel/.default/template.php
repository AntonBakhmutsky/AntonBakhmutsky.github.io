<?php


/** @var array $arParams */

/** @var array $arResult */

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<h2 class="pa__header">
	Отмена заказа
	<a class="pa__header-back-link" href="<?= $arResult["URL_TO_LIST"] ?>">
		<img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/pa/back-arrow.svg" alt="back-arrow">
		<span>Назад к текущим заказам</span>
	</a>
</h2>

<?php
if ($arResult["ERROR_MESSAGE"] == '') { ?>
	
	<form method="post" class="pa__cancel" action="<?= POST_FORM_ACTION_URI ?>">
		
		<input type="hidden" name="CANCEL" value="Y">
        <?= bitrix_sessid_post() ?>
		<input type="hidden" name="ID" value="<?= $arResult["ID"] ?>">
		
		<div class="pa__cancel-top">
			<div class="pa__cancel-title">
				Вы уверены что хотите отменить <a href="<?= $arResult["URL_TO_DETAIL"] ?>">заказ №<?= $arResult["ACCOUNT_NUMBER"] ?></a>?<br>
				Отмена заказа необратима
			</div>
			<div class="pa__cancel-textarea">
				<div class="pa__cancel-textarea-label">Укажите, пожалуйста, причину отмены заказа</div>
				<div class="pa__cancel-textarea-field"><textarea name="REASON_CANCELED" required></textarea></div>
			</div>
		</div>
		<div class="pa__cancel-bottom">
			<button class="pa__cancel-btn" name="action" type="submit" value="Y">Отменить заказ</button>
		</div>
	</form>
    <?php
} else {
    ShowError($arResult["ERROR_MESSAGE"]);
} ?>
