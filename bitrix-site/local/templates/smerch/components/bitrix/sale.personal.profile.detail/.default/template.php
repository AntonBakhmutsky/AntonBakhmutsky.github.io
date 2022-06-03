<?php


/** @var array $arParams */

/** @var array $arResult */

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

?>
	<h2 class="pa__header">
		Личные данные
		<a class="pa__header-back-link" href="<?= $arParams["PATH_TO_LIST"] ?>">
			<img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/pa/back-arrow.svg" alt="back"><span>Назад к списку адресов</span>
		</a>
	</h2>

<?php

ShowError($arResult["ERROR_MESSAGE"]);

if ($arResult["ID"] <> '') {
    ?>
	
	<form class="pa__data" method="post" action="<?= POST_FORM_ACTION_URI ?>" enctype="multipart/form-data">
        <?= bitrix_sessid_post() ?>
		<input type="hidden" name="ID" value="<?= $arResult["ID"] ?>">
		
		<div class="pa__data-header">Мой адрес</div>
		<div class="pa__data-block">
			<div class="pa__data-container">
				<div class="form__group form__group_full">
					<div class="form__label">Название адреса доставки</div>
					<div class="form__input">
						<input type="text" name="NAME" maxlength="50" value="<?= $arResult["NAME"] ?>" placeholder="Введите название адреса"/>
					</div>
				</div>
			</div>
		</div>
        <?php
        foreach ($arResult["ORDER_PROPS"] as $block) {
            if (! empty($block["PROPS"])) { ?>
				<div class="pa__data-block">
					<div class="pa__data-container">
						<div class="pa__data-title"><?= $block["NAME"] ?></div>
						<div class="pa__data-fields">
                            <?php
                            foreach ($block["PROPS"] as $property) {
                                $key = (int)$property["ID"];
                                $name = "ORDER_PROP_" . $key;
                                $currentValue = $arResult["ORDER_PROPS_VALUES"][$name]; ?>
								<div class="form__group form__group<?= $property["REQUIED"] === "Y" ? '_required' : '' ?><?= $property['TYPE'] === 'LOCATION' ? ' form__group_full' : '' ?>">
									<div class="form__label"><?= $property["NAME"] ?></div>
									<div class="form__input">
                                        <?php
                                        if ($property['TYPE'] === 'LOCATION') {
                                            $locationTemplate = ($arParams['USE_AJAX_LOCATIONS'] !== 'Y') ? "popup" : "";
                                            $locationClassName = 'location-block-wrapper';
                                            if ($arParams['USE_AJAX_LOCATIONS'] === 'Y') {
                                                $locationClassName .= ' location-block-wrapper-delimeter';
                                            }
                                            
                                            $locationValue = (int)($currentValue) ? (int)$currentValue : $property["DEFAULT_VALUE"];
                                            
                                            CSaleLocation::proxySaleAjaxLocationsComponent(
                                                [
                                                    "AJAX_CALL" => "N",
                                                    'CITY_OUT_LOCATION' => 'Y',
                                                    'COUNTRY_INPUT_NAME' => $name . '_COUNTRY',
                                                    'CITY_INPUT_NAME' => $name,
                                                    'LOCATION_VALUE' => $locationValue,
                                                ],
                                                [
                                                ],
                                                $locationTemplate,
                                                true,
                                                'location-block-wrapper'
                                            );
                                        } else { ?>
											<input
													type="text" name="<?= $name ?>"
													maxlength="50"
													value="<?= $currentValue ?>"
                                                <?= $property["REQUIED"] === "Y" ? 'required' : '' ?>
											/>
                                            <?php
                                        } ?>
									</div>
								</div>
                                <?php
                            } ?>
						</div>
					</div>
				</div>
                <?php
            }
        } ?>
		
		<div class="pa__data-block">
			<div class="pa__data-container pa__data-container_flex">
				<button type="submit" class="pa__data-cancel" name="reset" value="Y">ОТМЕНА</button>
				<button class="pa__data-save" type="submit" name="save" value="Y">СОХРАНИТЬ</button>
			</div>
		</div>
	</form>
    
    <?php
}

