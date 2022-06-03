<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var CBitrixComponentTemplate $this */
/** @var \SubscribeFormComponent $component */
/** @var array $arResult */

$formId = $this->GetEditAreaId('subscribe_form')
?>

<form class="mailing" id="<?= $formId ?>">
	<div class="container">
		<div class="mailing__text">
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                [
                    "AREA_FILE_RECURSIVE" => "Y",
                    "AREA_FILE_SHOW" => "sect",
                    "AREA_FILE_SUFFIX" => "subscribe_title",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "EDIT_TEMPLATE" => ""
                ]
            ) ?>
		</div>
		<div class="mailing__text">
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                [
                    "AREA_FILE_RECURSIVE" => "Y",
                    "AREA_FILE_SHOW" => "sect",
                    "AREA_FILE_SUFFIX" => "subscribe_text",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "EDIT_TEMPLATE" => ""
                ]
            ) ?>
		</div>
		<div class="mailing__field">
			<input type="email" placeholder="E-mail" required id="<?= $formId ?>_email">
			<div class="mailing__field-btn">
				<button type="submit">Да, хочу</button>
			</div>
		</div>
		<div class="mailing__text">
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                [
                    "AREA_FILE_RECURSIVE" => "Y",
                    "AREA_FILE_SHOW" => "sect",
                    "AREA_FILE_SUFFIX" => "subscribe_terms",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "EDIT_TEMPLATE" => ""
                ]
            ) ?>
		</div>
	</div>
</form>


<script type="text/javascript">
	BX.ready(function () {
		BX.SubscribeFormComponent.create('<?=$formId?>', {
			signedParameters: '<?= $this->getComponent()->getSignedParameters() ?>',
			componentName: '<?= $this->getComponent()->getName() ?>'
		});
	});
</script>
