<?php

/**
 * Bitrix vars
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent $component
 */

use Bitrix\Main\Security\Random;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(false);

if (! empty($arParams["~AUTH_RESULT"])) {
    if ($arParams["~AUTH_RESULT"]["TYPE"] === "OK") {
        ShowNote($arParams["~AUTH_RESULT"]["MESSAGE"]);
    } else {
        ShowError($arParams["~AUTH_RESULT"]["MESSAGE"]);
    }
}
if ($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]) {
    ShowNote(GetMessage("AUTH_EMAIL_SENT"));
}
?>
<section class="pa">
	<div class="container container_bg">
		<noindex>
			<form class="form" method="post" action="<?= $arResult["AUTH_URL"] ?>" name="bform" enctype="multipart/form-data">
				
				<input type="hidden" name="AUTH_FORM" value="Y"/>
				<input type="hidden" name="TYPE" value="REGISTRATION"/>
				
				<div class="form__header"><h2>Регистрация</h2></div>
				<div class="form__content">
					<div class="form__block">
						<div class="form__fields">
							<div class="form__title">Пожалуйста, зарегистрируйтесь</div>
							<div class="form__group form__group_required">
								<div class="form__label">Имя</div>
								<div class="form__input">
									<input type="text" name="USER_NAME" maxlength="255" value="<?= $arResult["USER_NAME"] ?>" placeholder="Введите имя"
									       required/>
								</div>
							</div>
							<div class="form__group form__group_required">
								<div class="form__label">Фамилия</div>
								<div class="form__input">
									<input type="text" name="USER_LAST_NAME" maxlength="255" value="<?= $arResult["USER_LAST_NAME"] ?>"
									       placeholder="Введите фамилию" required/>
								</div>
							</div>
							<div class="form__group form__group_required">
								<div class="form__label">E-mail</div>
								<div class="form__input">
									<input type="hidden" name="USER_LOGIN" maxlength="255" value="<?= Random::getString(10) ?>"/>
									<input type="email" name="USER_EMAIL" maxlength="255" value="<?= $arResult["USER_EMAIL"] ?>" placeholder="Введите почту"
									       required/>
								</div>
							</div>
							<div class="form__group form__group_required">
								<div class="form__label">Номер телефона</div>
								<div class="form__input">
									<input type="tel" name="USER_PHONE_NUMBER" maxlength="255" value="<?= $arResult["USER_PHONE_NUMBER"] ?>"
									       placeholder="Введите номер" required/>
								</div>
							</div>
							<div class="form__group form__group_required">
								<div class="form__label">Пароль</div>
								<div class="form__input">
									<input type="password" name="USER_PASSWORD" maxlength="255" value="<?= $arResult["USER_PASSWORD"] ?>" autocomplete="off"
									       placeholder="Введите пароль" required/>
								</div>
							</div>
							<div class="form__group form__group_required">
								<div class="form__label">Повторите пароль</div>
								<div class="form__input">
									<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>"
									       autocomplete="off" placeholder="Введите пароль" required/>
								</div>
							</div>
							<div class="form__check">
								<div class="form__checkbox">
                                    <?php
                                    app()->IncludeComponent(
                                        "bitrix:main.userconsent.request",
                                        "",
                                        [
                                            "ID" => COption::getOptionString("main", "new_user_agreement"),
                                            "IS_CHECKED" => "Y",
                                            "AUTO_SAVE" => "N",
                                            "IS_LOADED" => "Y",
                                            "ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
                                            "ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
                                            "INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
                                            "REPLACE" => [
                                                "button_caption" => GetMessage("AUTH_REGISTER"),
                                                "fields" => [
                                                    rtrim(GetMessage("AUTH_NAME"), ":"),
                                                    rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
                                                    rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
                                                    rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
                                                    rtrim(GetMessage("AUTH_EMAIL"), ":"),
                                                ]
                                            ],
                                        ]
                                    ) ?>
								</div>
							</div>
                            
                            <?php
                            if ($arResult["USE_CAPTCHA"] === "Y") { ?>
								<input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
								<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off"/>
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA"/>
                                <?php
                            } ?>
							
							<button class="form__btn form__btn_black" type="submit" class="btn btn-primary" name="Register"
							        value="<?= GetMessage("AUTH_REGISTER") ?>"><?= GetMessage("AUTH_REGISTER") ?></button>
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
                        } ?>
						
						<div class="form__message">
							<div class="form__container">
								<div class="form__title">Уже есть аккаунт?</div>
								<p>Если у вас уже есть аккаунт, пожалуйста авторизуйтесь.</p>
								<a class="form__btn" href="<?= $arResult["AUTH_AUTH_URL"] ?>" rel="nofollow">Авторизоваться</a>
							</div>
						</div>
					</div>
				</div>
			</form>
			
			
			<script type="text/javascript">
				document.bform.USER_NAME.focus();
			</script>
		</noindex>
	</div>
</section>
