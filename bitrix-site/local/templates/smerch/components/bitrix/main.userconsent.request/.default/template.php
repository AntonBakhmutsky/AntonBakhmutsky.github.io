<?php

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
?>

<label>
	<input type="hidden" value="N" name="<?= htmlspecialcharsbx($arParams['INPUT_NAME']) ?>">
	<input type="checkbox" value="Y" name="<?= htmlspecialcharsbx($arParams['INPUT_NAME']) ?>" required>
	<span>Я согласен с <a href="/info/privacy/" target="_blank">политикой конфиденциальности</a> и <a href="/info/terms/" target="_blank">пользовательским соглашением</a></span>
</label>
