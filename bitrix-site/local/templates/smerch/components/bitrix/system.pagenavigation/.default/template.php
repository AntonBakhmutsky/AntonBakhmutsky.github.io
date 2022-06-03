<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

if (! $arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false)) {
        return;
    }
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>

<div class="pagination">
    
    <?php
    if ($arResult["NavPageNomer"] > 2) { ?>
		<a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
		   class="pagination__arrow pagination__arrow_prev">
			<img src="<?= $templateFolder ?>/images/arrow-left.svg" alt="">
		</a>
        <?php
    } elseif ($arResult['NavPageNomer'] > 1) { ?>
		<a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>" class="pagination__arrow pagination__arrow_prev">
			<img src="<?= $templateFolder ?>/images/arrow-left.svg" alt="">
		</a>
        <?php
    } ?>
	
	<div class="pagination__container">
        
        <?php
        if ($arResult["nStartPage"] > 1) {
            ?>
			<a class="pagination__item" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">1</a>
            <?php
            if ($arResult["nStartPage"] > 2) { ?>
				<div class="pagination__item pagination__item_dots">...</div>
                <?php
            }
        }
        
        $page = $arResult["nStartPage"];
        do {
            if ($page == $arResult["NavPageNomer"]) { ?>
				<a class="pagination__item active"><?= $page ?></a>
                <?php
            } elseif ($page == 1) { ?>
				<a class="pagination__item" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1">1</a>
                <?php
            } else { ?>
				<a class="pagination__item"
				   href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $page ?>"><?= $page ?></a>
                <?php
            }
            
            $page++;
        } while ($page <= $arResult["nEndPage"]);
        
        if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
            if ($arResult["nEndPage"] < $arResult["NavPageCount"]) {
                if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)) { ?>
					<div class="pagination__item pagination__item_dots">...</div>
                    <?php
                } ?>
				<a class="pagination__item"
				   href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"><?= $arResult["NavPageCount"] ?></a>
                <?php
            }
        } ?>
	
	</div>
    
    <?php
    if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
		<a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
		   class="pagination__arrow pagination__arrow_next">
			<img src="<?= $templateFolder ?>/images/arrow-right.svg" alt="">
		</a>
        <?php
    } ?>

</div>
