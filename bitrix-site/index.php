<?php

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php";

app()->SetPageProperty('CLASS', 'main-page');
app()->SetPageProperty("title", "СМЕРЧ"); ?>
	
	<div class="lottie">
		<div class="lottie__container lottie__container_merch"></div>
		<div class="lottie__container lottie__container_collabs"></div>
		<div class="lottie__container lottie__container_apiece"></div>
        <div class="lottie__mobile lottie__mobile_merch"></div>
        <div class="lottie__mobile lottie__mobile_collabs"></div>
        <div class="lottie__mobile lottie__mobile_apiece"></div>
	</div>

<?php
app()->IncludeComponent(
    "itleague:iblock.list.component",
    "homepage",
    [
        "CACHE_TIME" => 3600000,
        "COMPOSITE_FRAME_MODE" => "Y",
        "COMPOSITE_FRAME_TYPE" => "STATIC",
    ],
    false
);


require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php";
