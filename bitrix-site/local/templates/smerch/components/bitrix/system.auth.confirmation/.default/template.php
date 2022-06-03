<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CUser $USER
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

$this->setFrameMode(false);

if (! empty($arResult["MESSAGE_TEXT"])) {
    if ($arResult["SHOW_FORM"]) {
        ShowError($arResult["MESSAGE_TEXT"]);
    } else {
        ShowNote($arResult["MESSAGE_TEXT"]);
    }
}

if ($arResult["SHOW_FORM"]) { ?>
	
	<section class="pa">
		<div class="container container_bg">
			<form class="pa__data" method="post" action="<?= $arResult["FORM_ACTION"] ?>">
				
				<div class="pa__data-header pa__data-header_center">Подтверждение E-mail</div>
				<div class="pa__data-block">
					<div class="pa__data-container">
						<div class="pa__data-title">Введите ваш E-mail и код подтверждения, который мы отправили на него</div>
						<div class="pa__data-fields">
							<div class="form__group form__group_required">
								<div class="form__label">Ваш E-mail</div>
								<div class="form__input">
									<input type="email" name="<?= $arParams["LOGIN"] ?>" maxlength="50" value="<?= $arResult["LOGIN"] ?>"
									       placeholder="Введите e-mail" required/>
								</div>
							</div>
							<div class="form__group form__group_required">
								<div class="form__label">Введите код подтверждения</div>
								<div class="form__input">
									<input type="text" name="<?= $arParams["CONFIRM_CODE"] ?>" maxlength="50" value="<?= $arResult["CONFIRM_CODE"] ?>"
									       placeholder="Введите код подтверждения" required/>
								</div>
							</div>
						</div>
						
						<button class="pa__data-password-save" type="submit" name="confirm" value="Y">Подтвердить</button>
					</div>
				</div>
			</form>
		</div>
	</section>
    
    <?php
} elseif (! $USER->IsAuthorized()) {
    app()->IncludeComponent("bitrix:system.auth.authorize", "", []);
}
