<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 */

if ($arParams["SET_TITLE"] == "Y") {
    app()->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
} ?>

<section class="robobox">
	<div class="container container_md">
		<div class="robobox__table">
            <?php
            if (! empty($arResult["ORDER"])) { ?>
				
				<div class="robobox__head">
					<div class="robobox__status">Ваш заказ №<?= $arResult["ORDER"]["ACCOUNT_NUMBER"] ?> от <?= $arResult["ORDER"]["DATE_INSERT"]->toUserTime(
                        )->format(
                            'd.m.Y H:i'
                        ) ?> <?= ($arResult["ORDER"]["PAYED"] === 'Y') ? 'успешно оформлен' : 'ожидает оплаты' ?>.
					</div>
                    <?php
                    if (! empty($arResult['ORDER']["PAYMENT_ID"])) { ?>
						<div class="robobox__num">Номер вашей оплаты: №<?= $arResult['PAYMENT'][$arResult['ORDER']["PAYMENT_ID"]]['ACCOUNT_NUMBER'] ?></div>
                        <?php
                    } ?>
				</div>
                <?php
                if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y') {
                    if (! empty($arResult["PAYMENT"])) {
                        foreach ($arResult["PAYMENT"] as $payment) {
                            if ($payment["PAID"] != 'Y') {
                                if (! empty($arResult['PAY_SYSTEM_LIST'])
                                    && array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
                                ) {
                                    $arPaySystem = $arResult['PAY_SYSTEM_LIST_BY_PAYMENT_ID'][$payment["ID"]];
                                    
                                    if (empty($arPaySystem["ERROR"])) { ?>
										<div class="robobox__body">
											<div class="robobox__text">
												<span>Услугу предоставляет сервис «ROBOKASSA»</span>
												<img src="<?= $arPaySystem['LOGOTIP']['SRC'] ?>" alt="<?= $arPaySystem['NAME'] ?>">
												<span><?= $arPaySystem['NAME'] ?></span>
											</div>
										</div>
										<div class="robobox__sum">
											<div class="robobox__sum-text">Сумма к оплате:</div>
											<div class="robobox__sum-num"><?= CurrencyFormat(
                                                    $arResult['ORDER']['PRICE'],
                                                    $arResult['ORDER']['CURRENCY']
                                                ) ?></div>
										</div>
										<div class="robobox__pay">
                                            <?php
                                            if ($arPaySystem["ACTION_FILE"] <> '' && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y") {
                                                $orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
                                                $paymentAccountNumber = $payment["ACCOUNT_NUMBER"]; ?>
												<script>
													window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
												</script>
												<a href="<?= $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . $orderAccountNumber . "&PAYMENT_ID=" . $paymentAccountNumber ?>"
												   class="black-btn">Оплатить заказ</a>
                                                <?php
                                                if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']){ ?>
                                                <br/>
                                                <?= Loc::getMessage(
                                                    "SOA_PAY_PDF",
                                                    ["#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . $orderAccountNumber . "&pdf=1&DOWNLOAD=Y"]
                                                ) ?>
                                                <?php
                                                }
                                            } else { ?>
												<script>
													document.forms["pay-form"].submit()
												</script>
                                                <?= $arPaySystem["BUFFERED_OUTPUT"] ?>
                                                <?php
                                            } ?>
										</div>
                                        <?php
                                    } else {
                                        ?>
										<div class="robobox__body">
											<div class="robobox__text" style="color:red"><?= Loc::getMessage("SOA_ORDER_PS_ERROR") ?></div>
										</div>
                                        <?php
                                    }
                                } else {
                                    ?>
									<div class="robobox__body">
										<div class="robobox__text" style="color:red"><?= Loc::getMessage("SOA_ORDER_PS_ERROR") ?></div>
									</div>
									<div class="robobox__sum"></div>
                                    <?php
                                }
                            }
                        }
                    } ?>
                    <?php
                } else { ?>
					<div class="robobox__body">
						<div class="robobox__text" style="color:red"><?= $arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'] ?></div>
					</div>
					<div class="robobox__sum"></div>
                    <?php
                }
            } else { ?>
				
				<div class="robobox__head">
					<div class="robobox__status"><?= Loc::getMessage("SOA_ERROR_ORDER") ?></div>
				</div>
				
				<div class="robobox__body">
					<div class="robobox__text">
                        <?= Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])]) ?><br>
                        <?= Loc::getMessage("SOA_ERROR_ORDER_LOST1") ?>
					</div>
				</div>
				<div class="robobox__sum"></div>
                
                <?php
            } ?>
		
		</div>
	</div>
</section>

