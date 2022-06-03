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
		<form class="pa__data" method="post" action="<?= $arResult["AUTH_URL"] ?>" name="bform">
            <?php
            if ($arResult["BACKURL"] <> '') { ?>
				<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                <?php
            } ?>
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="CHANGE_PWD">
			
			<input type="hidden" name="USER_LOGIN" maxlength="255" value="<?= $arResult["LAST_LOGIN"] ?>"/>
			
			<div class="pa__data-header pa__data-header_center">Смена пароля</div>
			<div class="pa__data-block">
				<div class="pa__data-container">
					<div class="pa__data-title">Задайте новый пароль</div>
					<div class="pa__data-fields">
                        <?php
                        if ($arResult["USE_PASSWORD"]) { ?>
							<div class="form__group form__group_required">
								<div class="form__label">Текущий пароль</div>
								<div class="form__input">
									<input type="password" name="USER_CURRENT_PASSWORD" maxlength="255" value="<?= $arResult["USER_CURRENT_PASSWORD"] ?>"
									       autocomplete="current-password" placeholder="Введите текущий пароль" required/>
								</div>
							</div>
                            <?php
                        } else { ?>
							<input type="hidden" name="USER_CHECKWORD" maxlength="255" value="<?= $arResult["USER_CHECKWORD"] ?>" autocomplete="off"/>
                            <?php
                        } ?>
						<div class="form__group form__group_required">
							<div class="form__label">Новый пароль</div>
							<div class="form__input">
								<input type="password" name="USER_PASSWORD" maxlength="255" value="<?= $arResult["USER_PASSWORD"] ?>"
								       autocomplete="new-password" placeholder="Введите пароль" required/>
							</div>
						</div>
						<div class="form__group form__group_required">
							<div class="form__label">Повторите пароль</div>
							<div class="form__input">
								<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>"
								       autocomplete="new-password" placeholder="Повторите пароль" required/>
							</div>
						</div>
					</div>
                    
                    <?php
                    if ($arResult["USE_CAPTCHA"]) { ?>
						<input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180" height="40"
						     alt="CAPTCHA"/>
						<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off"/>
                        <?php
                    } ?>
					
					<button class="pa__data-password-save" type="submit" name="change_pwd" value="Y">Сохранить новый пароль</button>
				</div>
			</div>
		</form>
	</div>
</section>


<script type="text/javascript">
	document.bform.USER_CHECKWORD.focus();
</script>

