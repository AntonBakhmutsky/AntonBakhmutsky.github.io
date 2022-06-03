<?php

/** @var CUser $USER */

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php";
app()->SetPageProperty('NAV_FOOTER', 'Y');
app()->SetTitle("Заказ не прошёл"); ?>

<section class="pa">
	<div class="container container_bg">
		<div class="pa__thx">
			<div class="pa__thx-top">
				<h3>Заказ не прошёл :(</h3>
                <?php
                if ($USER->IsAuthorized()) { ?>
					<p>Нам искренне жаль ваше время, но попробуйте вернуться к заказу и заново оплатить заказ.</p>
                    <?php
                } else { ?>
	                <p>Нам искренне жаль ваше время, но попробуйте заново собрать и оплатить заказ.</p>
                    <?php
                } ?>
			</div>
			
			<div class="pa__thx-bottom">
                <?php
                if ($USER->IsAuthorized()) { ?>
					<a href="/personal/orders/">перейти в текущие заказы</a>
                    <?php
                } else {
                    app()->IncludeComponent(
                        "itleague:iblock.list.component",
                        "fail.order",
                        [
                            "CACHE_TIME" => 3600000,
                            "COMPOSITE_FRAME_MODE" => "Y",
                            "COMPOSITE_FRAME_TYPE" => "STATIC",
                        ],
                        false
                    );
                } ?>
			</div>
		</div>
	</div>
</section>

<?php
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"; ?>
