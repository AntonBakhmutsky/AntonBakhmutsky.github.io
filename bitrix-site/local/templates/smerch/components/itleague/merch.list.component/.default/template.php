<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var CBitrixComponentTemplate $this */
/** @var \MerchListComponent $component */
/** @var array $arResult */

$buttons = CIBlock::GetPanelButtons($arResult['IBLOCK']['ID']);
$this->AddEditAction(
    'iblock_' . $arResult['IBLOCK']['ID'],
    $buttons['edit']['add_element']['ACTION_URL'],
    CIBlock::GetArrayByID($arResult['IBLOCK']['ID'], "ELEMENT_ADD")
);
?>

<div class="merch-tile" id="<?= $this->GetEditAreaId('iblock_' . $arResult['IBLOCK']['ID']) ?>">
	<div class="container">
        <?php
        
        foreach ($arResult['ITEMS'] as $item) {
            $picture = CFile::ResizeImageGet($item['PICTURE'], ['width' => 504, 'height' => 504], BX_RESIZE_IMAGE_EXACT, true);
            $iprops = $item['IPROPERTY_VALUES'];
            
            $buttons = CIBlock::GetPanelButtons($item['IBLOCK_ID'], $item['ID']);
            $this->AddEditAction($item['ID'], $buttons['edit']['edit_element']['ACTION_URL']);
            $this->AddDeleteAction($item['ID'], $buttons['edit']['delete_element']['ACTION_URL']);
            ?>
			<div class="merch-tile__item" id="<?= $this->GetEditAreaId($item['ID']) ?>">
				<img src="<?= $picture['src'] ?>" alt="<?= $iprops['ELEMENT_DETAIL_PICTURE_FILE_ALT'] ?? $item['NAME'] ?>"
				     width="<?= $picture['width'] ?>" height="<?= $picture['height'] ?>"
                    <?= isset($iprops['ELEMENT_DETAIL_PICTURE_FILE_TITLE']) ? 'title="' . $iprops['ELEMENT_DETAIL_PICTURE_FILE_TITLE'] . '"' : '' ?>>
			</div>
            <?php
        } ?>
	</div>
</div>
