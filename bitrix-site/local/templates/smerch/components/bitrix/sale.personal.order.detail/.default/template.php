<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * Bitrix vars
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent $component
 * @var string $templateFolder
 */

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;

?>
	
	
	<h2 class="pa__header">
		Заказ №<?= htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"]) ?>
		<span class="pa__header-date">от <?= $arResult["DATE_INSERT_FORMATED"] ?> на сумму <?= $arResult["PRICE_FORMATED"] ?>.</span>
		<a class="pa__header-back-link" href="<?= htmlspecialcharsbx($arResult["URL_TO_LIST"]) ?>">
			<img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/pa/back-arrow.svg" alt="back-arrow"><span>Назад к списку заказов</span></a>
	</h2>

<?php
if (! empty($arResult['ERRORS']['FATAL'])) {
    ShowError(implode('<br>', $arResult['ERRORS']['FATAL']));
} else {
    if (! empty($arResult['ERRORS']['NONFATAL'])) {
        ShowError(implode('<br>', $arResult['ERRORS']['NONFATAL']));
    }
    ?>
	
	<div class="pa__order-status">
        <?php
        foreach ($arResult['STATUSES'] as $status) { ?>
			<div class="pa__order-status-item<?= $status['ACTIVE'] ? ' active' : '' ?>">
				<div class="pa__order-status-item-image">
                    <?= File::getFileContents(Application::getDocumentRoot() . $templateFolder . "/images/{$status['ID']}.svg") ?>
				</div>
				<div class="pa__order-status-item-text"><?= $status['NAME'] ?></div>
			</div>
            <?php
        } ?>
	</div>
	<div class="pa__cards">
		<div class="order-card">
			<div class="order-card__middle">
                <?php
                foreach ($arResult['BASKET'] as $basketItem) { ?>
					<div class="order-card__desc">
						<div class="order-card__view">
							<div class="order-card__view-image">
								<img src="<?= $basketItem['PICTURE']['SRC'] ?>" alt="<?= $basketItem['NAME'] ?>">
							</div>
							<div class="order-card__view-name"><?= $basketItem['NAME'] ?></div>
						</div>
                        <?php
                        $size = $basketItem['PROPS'][0];
                        if ($size && $size['CODE'] === 'SIZE' && File::isFileExists(Application::getDocumentRoot() . $size['SKU_VALUE']['PICT']['SRC'])) { ?>
							<div class="order-card__size">
								<div class="order-card__size-image">
                                    <?= File::getFileContents(Application::getDocumentRoot() . $size['SKU_VALUE']['PICT']['SRC']) ?>
								</div>
							</div>
                            <?php
                        } ?>
						<div class="order-card__count"><?= $basketItem['QUANTITY'] ?> шт</div>
						<div class="order-card__price"><?= $basketItem['FORMATED_SUM'] ?></div>
					</div>
                    <?php
                } ?>
			</div>
			<div class="order-card__bottom">
                <?php
                if ($arResult['STATUS']['ID'] === 'N') {
                    foreach ($arResult['PAYMENT'] as $payment) {
                        if ($payment["PAID"] !== "Y"
                            && $payment['PAY_SYSTEM']["IS_CASH"] !== "Y"
                            && $payment['PAY_SYSTEM']['ACTION_FILE'] !== 'cash'
                            && $payment['PAY_SYSTEM']['PSA_NEW_WINDOW'] !== 'Y'
                            && $arResult['CANCELED'] !== 'Y'
                            && $arResult["IS_ALLOW_PAY"] !== "N") {
                            echo $payment['BUFFERED_OUTPUT'];
                        }
                    }
                } else { ?>
					<a class="order-card__repeat" href="<?= $arResult['URL_TO_COPY'] ?>">Повторить заказ</a>
                    <?php
                }
                ?>
			</div>
		</div>
	</div>
	<div class="pa__order-info">
        
        <?php
        $address = [];
        foreach ($arResult['ORDER_PROPS'] as $property) {
            if ((int)$property['PROPS_GROUP_ID'] === 1) {
                switch ($property['CODE']) {
                    case 'STREET':
                        $val = 'ул. ';
                        break;
                    case 'HOUSE':
                        $val = 'д. ';
                        break;
                    case 'FLAT':
                        $val = 'кв. ';
                        break;
                    default:
                        $val = '';
                }
                if ($property['VALUE']) {
                    $address[] = $val . $property['VALUE'];
                }
            }
        } ?>
		<div class="pa__order-info-item pa__order-info-item_address">
			<div class="pa__order-info-item-title">Адрес доставки:</div>
			<div class="pa__order-info-item-text"><?= implode(', ', $address) ?></div>
		</div>
        <?php
        foreach ($arResult['ORDER_PROPS'] as $property) {
            if ((int)$property['PROPS_GROUP_ID'] !== 1) {
                switch ($property['CODE']) {
                    case 'PHONE':
                        $class = 'phone';
                        break;
                    case 'CONTACT_PERSON':
                        $class = 'recipient';
                        break;
                    case 'EMAIL':
                        $class = 'mail';
                        break;
                    default:
                        $class = '';
                } ?>
				<div class="pa__order-info-item pa__order-info-item_<?= $class ?>">
					<div class="pa__order-info-item-title"><?= $property['NAME'] ?>:</div>
					<div class="pa__order-info-item-text"><?= $property['VALUE'] ?></div>
				</div>
                <?php
            }
        } ?>
	</div>
    <?php
}
