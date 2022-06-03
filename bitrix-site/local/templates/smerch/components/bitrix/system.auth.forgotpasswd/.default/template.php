<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 */

$this->setFrameMode(false);

if (! empty($arParams["~AUTH_RESULT"])) {
    if ($arParams["~AUTH_RESULT"]["TYPE"] === "OK") {
        ShowNote($arParams["~AUTH_RESULT"]["MESSAGE"]);
    } else {
        ShowError($arParams["~AUTH_RESULT"]["MESSAGE"]);
    }
}

?>

<section class="pa">
	<div class="container container_bg">
		<form class="pa__data" name="bform" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">
            <?php
            if ($arResult["BACKURL"] <> '') { ?>
				<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                <?php
            } ?>
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="SEND_PWD">
			
			<div class="pa__data-header pa__data-header_center">Восстановление пароля</div>
			<div class="pa__data-block">
				<div class="pa__data-container">
					<div class="pa__data-title">Введите E-mail аккаунта, к которому вы забыли пароль, на него будет
						отправлено письмо со ссылкой на смену пароля
					</div>
					<div class="pa__data-fields">
						<div class="form__group form__group_required">
							<div class="form__label">E-mail</div>
							<div class="form__input">
								<input type="email" name="USER_LOGIN" maxlength="255" value="<?= $arResult["USER_LOGIN"] ?>" placeholder="Введите почту"
								       required/>
							</div>
						</div>
                        
                        <?php
                        if ($arResult["USE_CAPTCHA"]) { ?>
							<input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
							<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA"/>
							<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off"/>
                            <?php
                        } ?>
						
						<button class="pa__data-password-recovery" type="submit" name="send_account_info" value="Y">восстановить пароль</button>
					</div>
					<div class="pa__data-link">Вспомнили пароль? <a href="<?= $arResult["AUTH_AUTH_URL"] ?>">Авторизизуйтесь</a></div>
				</div>
			</div>
		</form>
	</div>
</section>
