<?php

/** @var CUser $USER */

use Bitrix\Main\Context;

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php";
app()->SetPageProperty('NAV_FOOTER', 'Y');
app()->SetTitle("Спасибо за заказ"); ?>

<section class="pa">
	<div class="container container_bg">
		<div class="pa__thx">
			<div class="pa__thx-top">
				<h3>Спасибо за заказ <3</h3>
                <?php
                if(Context::getCurrent()->getRequest()->get('gift') === 'yes') {?>
                    <p>В течение нескольких минут вам придет письмо с сертификатом и электронный чек.</p>
                <?php }
                elseif ($USER->IsAuthorized()) { ?>
					<p>В течение нескольких минут вам придет письмо с подтверждением о заказе и электронный чек.<br>Это
						значит что мы получили ваш заказ и обрабатываем его. Когда мы передадим заказ в курьерскую
						службу<br>и курьер будет готов вам его доставить - он обязательно свяжется с вами по
						телефону.<br>Следить за статусом заказа вы можете в <a href="/personal/orders/">текущих заказах</a>.</p>
                    
                    <?php
                } else { ?>
					<p>В течение нескольких минут вам придет письмо с подтверждением о заказе и электронный чек.<br>
						Это значит что мы получили ваш заказ и обрабатываем его. Когда мы передадим заказ в курьерскую службу и курьер будет готов вам его
						доставить - он обязательно свяжется с вами по телефону.</p>
                    <?php
                } ?>
                <p>Если у вас есть вопросы по заказу - напишите нам на почту <a href="mailto:order@smerch.me">order@smerch.me</a></p>
			</div>
			
			<div class="pa__thx-bottom">
                <?php
                if ($USER->IsAuthorized()) { ?>
					<a href="/personal/orders/">перейти в текущие заказы</a>
                    <?php
                } else { ?>
					<a href="<?= SITE_DIR ?>">Ок, на главную</a>
                    <?php
                } ?>
			</div>
		</div>
	</div>
</section>

<?php
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"; ?>
