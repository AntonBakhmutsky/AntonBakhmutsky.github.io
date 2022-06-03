<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * Bitrix vars
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent $component
 */

use Bitrix\Main;
use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$historyPage = Main\Context::getCurrent()->getRequest()->get('filter_history') === 'Y'; ?>

    <h2 class="pa__header"><?= $historyPage ? 'ИСТОРИЯ ЗАКАЗОВ' : 'ТЕКУЩИЕ ЗАКАЗЫ' ?></h2>

<?php
if (!empty($arResult['ERRORS']['FATAL'])) {
    ShowError(implode('<br>', $arResult['ERRORS']['FATAL']));
} else {
    if (!empty($arResult['ERRORS']['NONFATAL'])) {
        ShowError(implode('<br>', $arResult['ERRORS']['NONFATAL']));
    } ?>

    <?php
    if (!count($arResult['ORDERS'])) { ?>


        <div class="pa__order-empty">
            <div class="pa__order-empty-text">
                <?= $historyPage ? 'Истории заказов не найдено' : 'Текущие заказы не найдены' ?>.
                Вы можете посмотреть <a href="/personal/orders/<?= !$historyPage ? '?filter_history=Y' : '' ?>">
                    <?= $historyPage ? 'текущие заказы' : 'историю заказов' ?>
                </a>
            </div>
            <?php
            app()->IncludeComponent(
                "itleague:iblock.list.component",
                "empty.orders",
                [
                    "CACHE_TIME" => 3600000,
                    "COMPOSITE_FRAME_MODE" => "Y",
                    "COMPOSITE_FRAME_TYPE" => "STATIC"
                ],
                $component,
                ['HIDE_ICONS' => 'Y']
            ) ?>
        </div>
        <?php
    } else { ?>

        <div class="pa__cards">
            <?php
            foreach ($arResult['ORDERS'] as $order) {
                $statusId = $order['ORDER']['STATUS_ID']; ?>
                <div class="order-card">
                    <div class="order-card__head">
                        <div class="order-card__number">ЗАКАЗ №<?= htmlspecialcharsbx($order['ORDER']['ACCOUNT_NUMBER']) ?></div>
                        <div class="order-card__status">
                            <?php
                            if ($statusId === 'F') {
                                $statusName = $statusDescription = str_replace(
                                    '#DATE#',
                                    $order['ORDER']['DATE_STATUS_FORMATED'],
                                    $arResult['INFO']['STATUS'][$statusId]['DESCRIPTION']
                                );
                            } else {
                                $statusName = $arResult['INFO']['STATUS'][$statusId]['NAME'];
                                $statusDescription = $arResult['INFO']['STATUS'][$statusId]['DESCRIPTION'];
                            } ?>
                            <div class="order-card__status-text"><?= htmlspecialcharsbx($statusName) ?></div>
                            <?php
                            if ($arResult['INFO']['STATUS'][$statusId]['DESCRIPTION']) { ?>
                                <div class="order-card__status-popup">
                                    <svg width="5" height="9" viewBox="0 0 5 9" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.85059 5.83105V5.51855C1.85059 5.16048 1.91569 4.86263 2.0459 4.625C2.17611 4.38737 2.40397 4.1416 2.72949 3.8877C3.11686 3.58171 3.36589 3.34408 3.47656 3.1748C3.59049 3.00553 3.64746 2.80371 3.64746 2.56934C3.64746 2.2959 3.55632 2.08594 3.37402 1.93945C3.19173 1.79297 2.92969 1.71973 2.58789 1.71973C2.27865 1.71973 1.99219 1.76367 1.72852 1.85156C1.46484 1.93945 1.20768 2.04525 0.957031 2.16895L0.546875 1.30957C1.20768 0.941732 1.91569 0.757812 2.6709 0.757812C3.30892 0.757812 3.8151 0.914062 4.18945 1.22656C4.5638 1.53906 4.75098 1.97038 4.75098 2.52051C4.75098 2.76465 4.71517 2.98275 4.64355 3.1748C4.57194 3.36361 4.46289 3.54427 4.31641 3.7168C4.17318 3.88932 3.92415 4.11393 3.56934 4.39062C3.2666 4.62826 3.06315 4.8252 2.95898 4.98145C2.85807 5.1377 2.80762 5.34766 2.80762 5.61133V5.83105H1.85059ZM1.65039 7.38867C1.65039 6.89714 1.88965 6.65137 2.36816 6.65137C2.60254 6.65137 2.78158 6.71647 2.90527 6.84668C3.02897 6.97363 3.09082 7.1543 3.09082 7.38867C3.09082 7.61979 3.02734 7.80371 2.90039 7.94043C2.77669 8.07389 2.59928 8.14062 2.36816 8.14062C2.13704 8.14062 1.95964 8.07552 1.83594 7.94531C1.71224 7.81185 1.65039 7.6263 1.65039 7.38867Z"
                                              fill="black"></path>
                                    </svg>
                                    <div class="order-card__status-popup-hidden"><?= htmlspecialcharsbx($statusDescription) ?></div>
                                </div>
                                <?php
                            } ?>
                        </div>
                    </div>
                    <div class="order-card__middle">
                        <?php
                        foreach ($order['BASKET_ITEMS'] as $basketItem) { ?>
                            <div class="order-card__desc">
                                <div class="order-card__view">
                                    <div class="order-card__view-image">
                                        <img src="<?= $arResult['INFO']['PICTURES'][$basketItem['PRODUCT_ID']]['PREVIEW']['src'] ?>">
                                    </div>
                                    <div class="order-card__view-name"><?= $basketItem['NAME'] ?></div>
                                </div>
                                <?php
                                if ($arResult['INFO']['PICTURES'][$basketItem['PRODUCT_ID']]['SIZE']) { ?>
                                    <div class="order-card__size">
                                        <div class="order-card__size-image">
                                            <?= File::getFileContents(
                                                Application::getDocumentRoot() . $arResult['INFO']['PICTURES'][$basketItem['PRODUCT_ID']]['SIZE']
                                            ) ?>
                                        </div>
                                    </div>
                                    <?php
                                } else { ?>
                                    <div class="order-card__size order-card__size_spot">
                                        <div class="order-card__size-image">
                                            <?= $arResult['INFO']['RATING'][$basketItem['PRODUCT_ID']] ?>
                                        </div>
                                    </div>
                                    <?php
                                } ?>
                                <div class="order-card__count"><?= $basketItem['QUANTITY'] ?> шт</div>
                                <div class="order-card__price"><?= CurrencyFormat(
                                        $basketItem['PRICE'] * $basketItem['QUANTITY'],
                                        $basketItem['CURRENCY']
                                    ) ?></div>
                            </div>
                            <?php
                        } ?>
                    </div>
                    <div class="order-card__bottom">
                        <a class="order-card__more" href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_DETAIL"]) ?>">
                            <?= Loc::getMessage('SPOL_TPL_MORE_ON_ORDER') ?>
                        </a>
                        <?php
                        if ($statusId === 'N') {
                            foreach ($order['PAYMENT'] as $payment) {
                                if ($payment['PAID'] === 'N' && $payment['IS_CASH'] !== 'Y' && $payment['ACTION_FILE'] !== 'cash') {
                                    if ($order['ORDER']['IS_ALLOW_PAY'] === 'N') { ?>
                                        <?= Loc::getMessage('SPOL_TPL_PAY') ?>
                                        <?php
                                    } elseif ($payment['NEW_WINDOW'] === 'Y') { ?>
                                        <a target="_blank" href="<?= htmlspecialcharsbx($payment['PSA_ACTION_FILE']) ?>">
                                            <?= Loc::getMessage('SPOL_TPL_PAY') ?></a>
                                        <?php
                                    } else {
                                        echo $payment['BUFFERED_OUTPUT'];
                                    }
                                }
                            }
                        } else { ?>
                            <a class="order-card__repeat" href="<?= $order['ORDER']['URL_TO_COPY'] ?>">Повторить заказ</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            } ?>
        </div>


        <?php
        echo $arResult["NAV_STRING"];
    }
}
