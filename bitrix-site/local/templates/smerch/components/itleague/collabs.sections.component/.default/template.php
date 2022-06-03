<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}


/** @var array $items */
/** @var array $arResult */

$buttons = CIBlock::GetPanelButtons($arResult['IBLOCK']['ID']);
$this->AddEditAction(
    'iblock_' . $arResult['IBLOCK']['ID'],
    $buttons['edit']['add_section']['ACTION_URL'],
    CIBlock::GetArrayByID($arResult['IBLOCK']['ID'], "SECTION_ADD")
); ?>

<div class="collabs-tile" id="<?= $this->GetEditAreaId('iblock_' . $arResult['IBLOCK']['ID']) ?>">
	<div class="container container_bg">
        <?php
        
        foreach ($arResult['SECTIONS'] as $section) {
            $picture = CFile::ResizeImageGet($section['PICTURE'], ['width' => 504, 'height' => 504], BX_RESIZE_IMAGE_EXACT, true);
            $iprops = $section['IPROPERTY_VALUES'];
            
            $buttons = CIBlock::GetPanelButtons($section['IBLOCK_ID'], 0, $section['ID']);
            $this->AddEditAction($section['ID'], $buttons['edit']['edit_section']['ACTION_URL']);
            $this->AddDeleteAction($section['ID'], $buttons['edit']['delete_section']['ACTION_URL']);
            ?>
			<a class="tile-card" id="<?= $this->GetEditAreaId($section['ID']) ?>" href="<?= $section['SECTION_PAGE_URL'] ?>">
				<div class="tile-card__image<?= $section['UF_ARCHIVED'] ? ' disabled' : '' ?>">
					<img src="<?= $picture['src'] ?>" alt="<?= $iprops['SECTION_PICTURE_FILE_ALT'] ?? $section['NAME'] ?>"
					     width="<?= $picture['width'] ?>" height="<?= $picture['height'] ?>"
                        <?= isset($iprops['SECTION_PICTURE_FILE_TITLE']) ? 'title="' . $iprops['SECTION_PICTURE_FILE_TITLE'] . '"' : '' ?>>
				</div>
				<div class="tile-card__text"><?= $section['NAME'] ?></div>
			</a>
            <?php
        } ?>
	</div>
</div>
