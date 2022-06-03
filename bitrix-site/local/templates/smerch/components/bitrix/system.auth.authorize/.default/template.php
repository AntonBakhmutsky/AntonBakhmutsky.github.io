<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

$this->setFrameMode(false);

ShowError($arParams["~AUTH_RESULT"]['MESSAGE']);
ShowError($arResult['ERROR_MESSAGE']); ?>

<section class="pa">
	<div class="container container_bg">
		<form class="form" name="form_auth" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">
			
			<input type="hidden" name="AUTH_FORM" value="Y"/>
			<input type="hidden" name="TYPE" value="AUTH"/>
            
            <?php
            if ($arResult["BACKURL"] <> '') { ?>
				<input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                <?php
            }
            
            foreach ($arResult["POST"] as $key => $value) { ?>
				<input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                <?php
            } ?>
			
			<div class="form__header"><h2>Авторизация</h2></div>
			<div class="form__content">
				<div class="form__block">
					<div class="form__fields">
						<div class="form__title">Пожалуйста, авторизуйтесь</div>
						<div class="form__group">
							<div class="form__label">E-mail</div>
							<div class="form__input">
								<input type="text" name="USER_LOGIN" maxlength="255" value="<?= $arResult["LAST_LOGIN"] ?>" placeholder="Введите e-mail"/>
							</div>
						</div>
						<div class="form__group">
							<div class="form__label">Пароль</div>
							<div class="form__input">
								<input type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" placeholder="Введите пароль"/>
							</div>
						</div>
                        
                        <?php
                        if ($arResult["CAPTCHA_CODE"]) { ?>
							<input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
							<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA"/>
							<input type="text" name="captcha_word" value="" autocomplete="off"/>
                            <?php
                        } ?>
						
						<div class="form__check">
                            <?php
                            if ($arResult["STORE_PASSWORD"] === "Y") { ?>
								<div class="form__checkbox">
									<label>
										<input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y"/>
										<span>Запомнить меня</span>
									</label>
								</div>
                                <?php
                            }
                            
                            if ($arParams["NOT_SHOW_LINKS"] !== "Y") { ?>
								<a class="form__recovery-link" href="<?= $arResult["AUTH_FORGOT_PASSWORD_URL"] ?>" rel="nofollow">Забыли пароль?</a>
                                <?php
                            } ?>
						</div>
						
						<button type="submit" class="form__btn form__btn_black" name="Login" value="Y">
                            <?= GetMessage("AUTH_AUTHORIZE") ?>
						</button>
					</div>
				</div>
				
				<div class="form__block">
                    <?php
                    if ($arResult["AUTH_SERVICES"]) {
                        app()->IncludeComponent(
                            "bitrix:socserv.auth.form",
                            "",
                            [
                                "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                                "AUTH_URL" => $arResult["AUTH_URL"],
                                "POST" => $arResult["POST"],
                            ],
                            $component,
                            ["HIDE_ICONS" => "Y"]
                        );
                    }
                    if ($arParams["NOT_SHOW_LINKS"] !== "Y" && $arResult["NEW_USER_REGISTRATION"] === "Y" && $arParams["AUTHORIZE_REGISTRATION"] !== "Y") { ?>
						<noindex>
							<div class="form__message">
								<div class="form__container">
									<div class="form__title">Регистрация</div>
									<p><?= GetMessage("AUTH_FIRST_ONE") ?></p>
									<a class="form__btn" href="<?= $arResult["AUTH_REGISTER_URL"] ?>" rel="nofollow"><?= GetMessage("AUTH_REGISTER") ?></a>
								</div>
							</div>
						</noindex>
                        <?php
                    } ?>
				
				</div>
		</form>
	</div>
</section>
<script type="text/javascript">
    <?php if ($arResult["LAST_LOGIN"] <> '') {?>
	try {
		document.form_auth.USER_PASSWORD.focus();
	} catch (e) {
	}
    <?php } else {?>
	try {
		document.form_auth.USER_LOGIN.focus();
	} catch (e) {
	}
    <?php }?>
</script>

