<?php

/**
 * @var array $arParams
 * @var array $arResult
 */
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

?>


<h2 class="pa__header">Личные денные</h2>

<?php
ShowError($arResult["strProfileError"]);
if ($arResult['DATA_SAVED'] === 'Y') {
    ShowNote('Изменения сохранены');
}
?>

<form class="pa__data" method="post" name="form1" action="<?= $arResult["FORM_TARGET"] ?>" enctype="multipart/form-data">
    <?= $arResult["BX_SESSION_CHECK"] ?>
	<input type="hidden" name="lang" value="<?= LANG ?>"/>
	<input type="hidden" name="ID" value="<?= $arResult["ID"] ?>"/>
	
	<div class="pa__data-block">
		<div class="pa__data-container">
			<div class="pa__data-title">Основная информация</div>
			<div class="pa__data-fields">
				<div class="form__group form__group_required">
					<div class="form__label">Имя</div>
					<div class="form__input">
						<input type="text" name="NAME" maxlength="50" value="<?= $arResult["arUser"]["NAME"] ?>" placeholder="Введите имя" required/>
					</div>
				</div>
				<div class="form__group form__group_required">
					<div class="form__label">Фамилия</div>
					<div class="form__input">
						<input type="text" name="LAST_NAME" maxlength="50" value="<?= $arResult["arUser"]["LAST_NAME"] ?>" placeholder="Введите фамилию"
						       required/>
					</div>
				</div>
				<div class="form__group">
					<div class="form__label">Отчество</div>
					<div class="form__input">
						<input type="text" name="SECOND_NAME" maxlength="50" value="<?= $arResult["arUser"]["SECOND_NAME"] ?>" placeholder="Введите отчество"/>
					</div>
				</div>
				<div class="form__group form__group_required">
					<div class="form__label">E-mail</div>
					<div class="form__input">
						<input type="email" name="EMAIL" maxlength="50" value="<?= $arResult["arUser"]["EMAIL"] ?>" placeholder="Введите почту" required/>
					</div>
				</div>
				<div class="form__group form__group_required">
					<div class="form__label">Номер телефона</div>
					<div class="form__input">
						<input type="tel" name="PERSONAL_PHONE" maxlength="50" value="<?= $arResult["arUser"]["PERSONAL_PHONE"] ?>" placeholder="Введите номер"
						       required/>
					</div>
				</div>
				<div class="form__group">
					<div class="form__label">Дата рождения</div>
					<div class="form__input">
                        <?php
                        $date = $arResult["arUser"]["PERSONAL_BIRTHDAY"] ? date('Y-m-d', strtotime($arResult["arUser"]["PERSONAL_BIRTHDAY"])) : '' ?>
						<input name="PERSONAL_BIRTHDAY" type="date" id="YMDdate" value="<?= $date ?>"/>
						<input name="PERSONAL_BIRTHDAY" type="hidden" id="DMYdate" value="<?= $arResult["arUser"]["PERSONAL_BIRTHDAY"] ?>"/>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php
    if ($arResult['CAN_EDIT_PASSWORD']) { ?>
		<div class="pa__data-block">
			<div class="pa__data-container">
				<div class="pa__data-title">Изменить пароль</div>
				<div class="pa__data-fields">
					<div class="form__group form__group_required">
						<div class="form__label">Новый пароль</div>
						<div class="form__input">
							<input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" placeholder="Введите пароль"/>
						</div>
					</div>
					<div class="form__group form__group_required">
						<div class="form__label">Повторите пароль</div>
						<div class="form__input">
							<input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" placeholder="Повторите пароль"/>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php
    } ?>
	<div class="pa__data-block">
		<div class="pa__data-container pa__data-container_flex">
			<button class="pa__data-cancel" type="reset">ОТМЕНА</button>
			<button class="pa__data-save" type="submit" name="save" value="Y">СОХРАНИТЬ</button>
		</div>
	</div>
    <?php
    if ($arResult["SOCSERV_ENABLED"]) { ?>
		<div class="pa__data-block">
			<div class="pa__data-container">
				<div class="pa__data-title">Привязанные соцсети</div>
                <?php
                app()->IncludeComponent(
                    "bitrix:socserv.auth.split",
                    "",
                    [
                        "SHOW_PROFILES" => "Y",
                        "ALLOW_DELETE" => "Y"
                    ],
                    false
                ) ?>
			</div>
		</div>
        <?php
    }
    ?>
</form>
<div class="pa__logout"><a href="/?logout=yes&<?= bitrix_sessid_get() ?>">Выйти из аккаунта</a></div>


