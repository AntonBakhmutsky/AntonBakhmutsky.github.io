<?php

namespace Sprint\Migration;


class Version20220323140436 extends Version
{
    protected $description = "Новые почтовые события на оформление заказа";

    protected $moduleVersion = "4.0.2";

    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();

        $fields = [
            'LID' => ['s1'],
            'ACTIVE' => 'Y',
            'EMAIL_FROM' => '#SALE_EMAIL#',
            'EMAIL_TO' => '#EMAIL#',
            'SUBJECT' => '#SITE_NAME#: ЗАКАЗ N#ORDER_ID#',
            'MESSAGE' => '<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" style="background-color: #fff;">
    <tbody>
    <tr>
        <td align="center">
            <table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; overflow: hidden;">
                <tbody>
                <tr>
                    <td style="padding-top: 20px; padding-bottom: 20px;">
                        <table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" style="border-bottom: 1px solid #8c8888;">
                            <tbody>
                            <tr>
                                <td align="left" style="padding-left: 6.25%; padding-bottom: 20px;">
                                    <a href="https://#SERVER_NAME#" target="_blank"><img width="60" alt="smerch" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/logo.png"></a>
                                </td>
                                <td align="right" style="padding-right: 6.25%; padding-bottom: 20px;">
                                    <a href="#" target="_blank" style="font-family: Tahoma, sans-serif; font-weight: 300; font-size: 12px; line-height: 16px; color: #000; text-align: right; text-decoration: none;">Открыть в браузере</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td style="padding-top: 25px; padding-left: 6.25%; padding-right: 6.25%; padding-bottom: 40px;">
                                    <p style="margin-top: 0; margin-bottom: 24px; font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;">
                                        #ORDER_USER#, спасибо за заказ &lt;3
                                    </p>
                                    <p style="margin-top: 22px; margin-bottom: 30px; font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;">
                                        Ваш заказ №#ORDER_ID# от #ORDER_DATE# успешно оплачен.
                                    </p>
                                    <table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" border="#000">
                                        <thead>
                                        <tr>
                                            <td style="padding: 10px 12px">
                                                <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 0; text-transform: uppercase;">
                                                    ЗАКАЗ №#ORDER_ID#
                                                </p>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        #TABLE_ORDER_LIST#
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td align="right" style="padding: 10px">
                                                <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 0;">
                                                    Стоимость заказа: #TOTAL_SUM#
                                                </p>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <a href="https://#SERVER_NAME#/personal/orders/#ORDER_ACCOUNT_NUMBER_ENCODE#" target="_blank" style="text-decoration: none; font-family: Tahoma, sans-serif; font-size: 12px; line-height: 36px; text-align: center; font-weight: 300; color: #FFFFFF; text-transform: uppercase; width: 260px; height: 36px; background-color: #000; display: block;">Подробнее о заказе</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0 6.25%;">
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 30px 0 20px;">
                                        Это письмо значит, что мы получили ваш заказ и обрабатываем его. Обычно обработка заказа занимает от пары часов до пары дней, всё зависит от того, в какое время и в какой день недели вы оформили заказ.
                                    </p>
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
                                        Когда мы передадим ваш заказ в курьерскую службу, вам придет письмо с трек-номером, по которому можно будет отслеживать заказ. Мы передаем заказ в курьерскую службу в течение 1-3 дней после оформления заказа у нас на сайте. Если вы оформили заказ в пт после 12:00, то мы его передадим уже только в пн.
                                    </p>
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
                                        Если вы зарегистрированы у нас на сайте, то вы можете следить за статусом заказа просто у себя в личном кабинете.
                                    </p>
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
                                        Это письмо отправлено автоматически, но если у вас есть вопросы по заказу - задайте нам их в ответ на это письмо, и мы обязательно ответим в течение рабочего дня.
                                    </p>
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
                                        Мы работаем пн-пт с 10.00 до 19.00.
                                    </p>
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
                                        СМЕРЧ <br>
                                        &lt;3
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table role="presentation" aria-hidden="true" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody style="border-top: 1px solid #8c8888; border-bottom: 1px solid #8c8888">
                                        <tr>
                                            <td style="padding: 28px 0 28px 6.25%;">
                                                <p style="margin: 0; text-align: center; width: 63px">
                                                    <img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/planet.png"><br>
                                                    <a href="https://#SERVER_NAME#" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">smerch.me</a>
                                                </p>
                                            </td>
                                            <td style="padding: 28px 0; text-align: center;">
                                                <p style="margin: 0 auto; width: 121px;">
                                                    <img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/mail.png"><br>
                                                    <a href="mailto:order@smerch.me" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">order@smerch.me</a>
                                                </p>
                                            </td>
                                            <td style="padding: 28px 6.25% 28px 0; text-align: center;" align="right">
                                                <p style="margin: 0 0 0 auto; width: 67px;">
                                                    <img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/insta.png"><br>
                                                    <a href="https://www.instagram.com/smerch.me/" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">smerch.me</a>
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                        <tr valign="center">
                                            <td align="left" style="padding: 16px 6.25%;">
                                                <a href="https://#SERVER_NAME#" target="_blank"><img width="60" alt="smerch" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/logo.png"></a>
                                            </td>
                                            <td align="right" style="padding: 16px 6.25%;">
                                                <p style="font-family: Tahoma, sans-serif; font-size: 10px; line-height: 14px; font-weight: 300; margin: 0;color: #8c8888;">
                                                    © 2017- 2021 СМЕРЧ г. Москва
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
',
            'BODY_TYPE' => 'html',
            'BCC' => '#BCC#',
            'REPLY_TO' => '',
            'CC' => '',
            'IN_REPLY_TO' => '',
            'PRIORITY' => '',
            'FIELD1_NAME' => '',
            'FIELD1_VALUE' => '',
            'FIELD2_NAME' => '',
            'FIELD2_VALUE' => '',
            'SITE_TEMPLATE_ID' => '',
            'ADDITIONAL_FIELD' => [['NAME' => 'type', 'VALUE' => 'dpd_door']],
            'LANGUAGE_ID' => '',
            'EVENT_TYPE' => '[ SALE_ORDER_PAID ] Заказ оплачен',
        ];
        $helper->Event()->saveEventMessage('SALE_ORDER_PAID', $fields);
        $fields['ADDITIONAL_FIELD'] = [['NAME' => 'type', 'VALUE' => 'dpd_point']];
        $helper->Event()->addEventMessage('SALE_ORDER_PAID', $fields);
        $fields['ADDITIONAL_FIELD'] = [['NAME' => 'type', 'VALUE' => 'pickup']];
        $helper->Event()->addEventMessage('SALE_ORDER_PAID', $fields);

        $fields = [
            'LID' => ['s1'],
            'ACTIVE' => 'Y',
            'EMAIL_FROM' => '#SALE_EMAIL#',
            'EMAIL_TO' => '#EMAIL#',
            'SUBJECT' => '#SITE_NAME#: ЗАКАЗ N#ORDER_ID# ДОСТАВЛЯЕТСЯ',
            'MESSAGE' => '<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" style="background-color: #fff;">
<tbody>
<tr>
	<td align="center">
		<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; overflow: hidden;">
		<tbody>
		<tr>
			<td style="padding-top: 20px; padding-bottom: 20px;">
				<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" style="border-bottom: 1px solid #8c8888;">
				<tbody>
				<tr>
					<td align="left" style="padding-left: 6.25%; padding-bottom: 20px;">
						<a href="https://#SERVER_NAME#" target="_blank"><img width="60" alt="smerch" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/logo.png"></a>
					</td>
					<td align="right" style="padding-right: 6.25%; padding-bottom: 20px;">
						<a href="#" target="_blank" style="font-family: Tahoma, sans-serif; font-weight: 300; font-size: 12px; line-height: 16px; color: #000; text-align: right; text-decoration: none;">Открыть в браузере</a>
					</td>
				</tr>
				</tbody>
				</table>
				<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
				<tr>
					<td style="padding-top: 25px; padding-left: 6.25%; padding-right: 6.25%; padding-bottom: 40px;">
						<p style="margin-top: 0; margin-bottom: 24px; font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;">
							 #ORDER_USER#, мы передали ваш <a href="https://#SERVER_NAME#/personal/orders/#ORDER_ACCOUNT_NUMBER_ENCODE#" style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;color: #000;">заказ №#ORDER_ID#</a> в курьерскую службу DPD.
						</p>
						<p style="margin-top: 22px; margin-bottom: 16px; font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;">
							 Трек-номер вашего заказа:
						</p>
						<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
						<tr>
							<td style="padding: 18px 10px">
								<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: auto;">
								<tbody>
								<tr>
									<td align="center">
										<p style="font-family: Tahoma, sans-serif; font-size: 18px; line-height: 24px; font-weight: 300; margin: 0, text-transform: uppercase; margin:0;">
											 #ORDER_TRACKING_NUMBER#
										</p>
									</td>
								</tr>
								</tbody>
								</table>
							</td>
						</tr>
						</tbody>
						</table>
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin-top: 13px;">
							 Вы можете отследить его статус на сайте <a href="https://www.dpd.ru" style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;color: #000;">https://www.dpd.ru</a>
						</p>
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="https://www.dpd.ru" target="_blank" style="text-decoration: none; font-family: Tahoma, sans-serif; font-size: 12px; line-height: 36px; text-align: center; font-weight: 300; color: #FFFFFF; text-transform: uppercase; width: 260px; height: 36px; background-color: #000; display: block;">перейти на сайт DPD</a>
					</td>
				</tr>
				<tr>
					<td style="padding: 0 6.25%;">
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 30px 0;">
							 Когда курьер будет готов доставить ваш заказ – он обязательно свяжется с вами по указанному при оформлении заказа телефону.
						</p>
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
							Это письмо отправлено автоматически, но если у вас есть вопросы по заказу - задайте нам их в ответ на это письмо, и мы обязательно ответим в течение рабочего дня.
						</p>
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
							 Мы работаем пн-пт с 10.00 до 19.00.
						</p>
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
							 СМЕРЧ <br>
							&lt;3
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<table role="presentation" aria-hidden="true" cellpadding="0" cellspacing="0" width="100%">
						<tbody style="border-top: 1px solid #8c8888; border-bottom: 1px solid #8c8888">
						<tr>
							<td style="padding: 28px 0 28px 6.25%;">
								<p style="margin: 0; text-align: center; width: 63px">
									<img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/planet.png"><br>
									<a href="https://#SERVER_NAME#" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">smerch.me</a>
								</p>
							</td>
							<td style="padding: 28px 0; text-align: center;">
								<p style="margin: 0 auto; width: 121px;">
									<img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/mail.png"><br>
									<a href="mailto:order@smerch.me" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">order@smerch.me</a>
								</p>
							</td>
							<td style="padding: 28px 6.25% 28px 0; text-align: center;" align="right">
								<p style="margin: 0 0 0 auto; width: 67px;">
									<img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/insta.png"><br>
									<a href="https://www.instagram.com/smerch.me/" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">smerch.me</a>
								</p>
							</td>
						</tr>
						</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
						<tr valign="center">
							<td align="left" style="padding: 16px 6.25%;">
								<a href="https://#SERVER_NAME#" target="_blank"><img width="60" alt="smerch" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/logo.png"></a>
							</td>
							<td align="right" style="padding: 16px 6.25%;">
								<p style="font-family: Tahoma, sans-serif; font-size: 10px; line-height: 14px; font-weight: 300; margin: 0;color: #8c8888;">
									 © 2017- 2021 СМЕРЧ г. Москва
								</p>
							</td>
						</tr>
						</tbody>
						</table>
					</td>
				</tr>
				</tbody>
				</table>
			</td>
		</tr>
		</tbody>
		</table>
	</td>
</tr>
</tbody>
</table>',
            'BODY_TYPE' => 'html',
            'BCC' => '',
            'REPLY_TO' => '',
            'CC' => '',
            'IN_REPLY_TO' => '',
            'PRIORITY' => '',
            'FIELD1_NAME' => '',
            'FIELD1_VALUE' => '',
            'FIELD2_NAME' => '',
            'FIELD2_VALUE' => '',
            'SITE_TEMPLATE_ID' => '',
            'ADDITIONAL_FIELD' => [['NAME' => 'type', 'VALUE' => 'dpd_door']],
            'LANGUAGE_ID' => '',
            'EVENT_TYPE' => '[ SALE_ORDER_TRACKING_NUMBER ] Уведомление об изменении идентификатора почтового отправления',
        ];
        $helper->Event()->saveEventMessage('SALE_ORDER_TRACKING_NUMBER', $fields);
        $fields['ADDITIONAL_FIELD'] = [['NAME' => 'type', 'VALUE' => 'dpd_point']];
        $helper->Event()->addEventMessage('SALE_ORDER_TRACKING_NUMBER', $fields);
        $fields['ADDITIONAL_FIELD'] = [['NAME' => 'type', 'VALUE' => 'pickup']];
        $helper->Event()->addEventMessage('SALE_ORDER_TRACKING_NUMBER', $fields);

        $helper->Event()->deleteEventMessage(['EVENT_NAME' => 'SALE_ORDER_PAID', 'SUBJECT' => 'Новый заказ']);
        $helper->Event()->saveEventType('ORDER_PAID_ADMIN', array(
            'LID' => 'ru',
            'EVENT_TYPE' => 'email',
            'NAME' => 'Заказ оплачен (для администратора)',
            'DESCRIPTION' => '#ORDER_ID# - код заказа
#ORDER_ACCOUNT_NUMBER_ENCODE# - код заказа(для ссылок)
#ORDER_REAL_ID# - реальный ID заказа
#ORDER_DATE# - дата заказа
#EMAIL# - E-Mail пользователя
#ORDER_PUBLIC_URL# - ссылка для просмотра заказа без авторизации (требуется настройка в модуле интернет-магазина)
#SALE_EMAIL# - E-Mail отдела продаж
#ORDER_LIST# - список товаров
#TABLE_ORDER_LIST# - список товаров для таблицы
#TOTAL_SUM# - сумма заказа
#ORDER_USER# - данные пользователя',
            'SORT' => '150',
        ));
        $helper->Event()->saveEventType('ORDER_PAID_ADMIN', array(
            'LID' => 'en',
            'EVENT_TYPE' => 'email',
            'NAME' => 'Paid order (for admin)',
            'DESCRIPTION' => '#ORDER_ID# - order ID
#ORDER_ACCOUNT_NUMBER_ENCODE# - order ID (for URL\'s)
#ORDER_REAL_ID# - real order ID
#ORDER_DATE# - order date
#EMAIL# - customer e-mail
#ORDER_PUBLIC_URL# - order view link for unauthorized users (requires configuration in the e-Store module settings)
#SALE_EMAIL# - sales dept. e-mail',
            'SORT' => '150',
        ));
        $helper->Event()->saveEventMessage('ORDER_PAID_ADMIN', array(
            'LID' =>
                array(
                    0 => 's1',
                ),
            'ACTIVE' => 'Y',
            'EMAIL_FROM' => '#SALE_EMAIL#',
            'EMAIL_TO' => 'order@smerch.me',
            'SUBJECT' => 'Новый заказ',
            'MESSAGE' => 'Привет, пришел новый заказ))<br>
 <br>
 Номер заказа: #ORDER_REAL_ID#<br>
 Дата заказа: #ORDER_DATE#<br>
 Сумма заказа: #TOTAL_SUM#<br>
 <br>
 Состав заказа:<br>
 #ORDER_LIST#<br>
 <br>
 Покупатель: #ORDER_USER#<br>
 Emai покупателя: #EMAIL#<br>
 <br>
Письмо сгенерировано автоматически, йоу)',
            'BODY_TYPE' => 'html',
            'BCC' => '',
            'REPLY_TO' => '',
            'CC' => 'manych@smerch.me',
            'IN_REPLY_TO' => '',
            'PRIORITY' => '',
            'FIELD1_NAME' => '',
            'FIELD1_VALUE' => '',
            'FIELD2_NAME' => '',
            'FIELD2_VALUE' => '',
            'SITE_TEMPLATE_ID' => '',
            'ADDITIONAL_FIELD' =>
                array(),
            'LANGUAGE_ID' => '',
            'EVENT_TYPE' => '[ ORDER_PAID_ADMIN ] Заказ оплачен (для администратора)',
        ));
    }

    public function down()
    {
        $helper = $this->getHelperManager();

        $helper->Event()->deleteEventMessage(['EVENT_NAME' => 'SALE_ORDER_PAID', 'SUBJECT' => '#SITE_NAME#: ЗАКАЗ N#ORDER_ID#']);
        $helper->Event()->deleteEventMessage(['EVENT_NAME' => 'SALE_ORDER_PAID', 'SUBJECT' => '#SITE_NAME#: ЗАКАЗ N#ORDER_ID#']);
        $helper->Event()->saveEventMessage('SALE_ORDER_PAID', [
            'LID' => ['s1'],
            'ACTIVE' => 'Y',
            'EMAIL_FROM' => '#SALE_EMAIL#',
            'EMAIL_TO' => '#EMAIL#',
            'SUBJECT' => '#SITE_NAME#: ЗАКАЗ N#ORDER_ID#',
            'MESSAGE' => '<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" style="background-color: #fff;">
    <tbody>
    <tr>
        <td align="center">
            <table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; overflow: hidden;">
                <tbody>
                <tr>
                    <td style="padding-top: 20px; padding-bottom: 20px;">
                        <table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" style="border-bottom: 1px solid #8c8888;">
                            <tbody>
                            <tr>
                                <td align="left" style="padding-left: 6.25%; padding-bottom: 20px;">
                                    <a href="https://#SERVER_NAME#" target="_blank"><img width="60" alt="smerch" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/logo.png"></a>
                                </td>
                                <td align="right" style="padding-right: 6.25%; padding-bottom: 20px;">
                                    <a href="#" target="_blank" style="font-family: Tahoma, sans-serif; font-weight: 300; font-size: 12px; line-height: 16px; color: #000; text-align: right; text-decoration: none;">Открыть в браузере</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td style="padding-top: 25px; padding-left: 6.25%; padding-right: 6.25%; padding-bottom: 40px;">
                                    <p style="margin-top: 0; margin-bottom: 24px; font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;">
                                        #ORDER_USER#, спасибо за заказ &lt;3
                                    </p>
                                    <p style="margin-top: 22px; margin-bottom: 30px; font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;">
                                        Ваш заказ №#ORDER_ID# от #ORDER_DATE# успешно оплачен.
                                    </p>
                                    <table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" border="#000">
                                        <thead>
                                        <tr>
                                            <td style="padding: 10px 12px">
                                                <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 0; text-transform: uppercase;">
                                                    ЗАКАЗ №#ORDER_ID#
                                                </p>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        #TABLE_ORDER_LIST#
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td align="right" style="padding: 10px">
                                                <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 0;">
                                                    Стоимость заказа: #TOTAL_SUM#
                                                </p>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <a href="https://#SERVER_NAME#/personal/orders/#ORDER_ACCOUNT_NUMBER_ENCODE#" target="_blank" style="text-decoration: none; font-family: Tahoma, sans-serif; font-size: 12px; line-height: 36px; text-align: center; font-weight: 300; color: #FFFFFF; text-transform: uppercase; width: 260px; height: 36px; background-color: #000; display: block;">Подробнее о заказе</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0 6.25%;">
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 30px 0 20px;">
                                        Это письмо значит, что мы получили ваш заказ и обрабатываем его. Обычно обработка заказа занимает от пары часов до пары дней, всё зависит от того, в какое время и в какой день недели вы оформили заказ.
                                    </p>
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
                                        Когда мы передадим ваш заказ в курьерскую службу, вам придет письмо с трек-номером, по которому можно будет отслеживать заказ. Мы передаем заказ в курьерскую службу в течение 1-3 дней после оформления заказа у нас на сайте. Если вы оформили заказ в пт после 12:00, то мы его передадим уже только в пн.
                                    </p>
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
                                        Если вы зарегистрированы у нас на сайте, то вы можете следить за статусом заказа просто у себя в личном кабинете.
                                    </p>
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
                                        Это письмо отправлено автоматически, но если у вас есть вопросы по заказу - задайте нам их в ответ на это письмо, и мы обязательно ответим в течение рабочего дня.
                                    </p>
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
                                        Мы работаем пн-пт с 10.00 до 19.00.
                                    </p>
                                    <p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
                                        СМЕРЧ <br>
                                        &lt;3
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table role="presentation" aria-hidden="true" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody style="border-top: 1px solid #8c8888; border-bottom: 1px solid #8c8888">
                                        <tr>
                                            <td style="padding: 28px 0 28px 6.25%;">
                                                <p style="margin: 0; text-align: center; width: 63px">
                                                    <img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/planet.png"><br>
                                                    <a href="https://#SERVER_NAME#" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">smerch.me</a>
                                                </p>
                                            </td>
                                            <td style="padding: 28px 0; text-align: center;">
                                                <p style="margin: 0 auto; width: 121px;">
                                                    <img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/mail.png"><br>
                                                    <a href="mailto:order@smerch.me" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">order@smerch.me</a>
                                                </p>
                                            </td>
                                            <td style="padding: 28px 6.25% 28px 0; text-align: center;" align="right">
                                                <p style="margin: 0 0 0 auto; width: 67px;">
                                                    <img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/insta.png"><br>
                                                    <a href="https://www.instagram.com/smerch.me/" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">smerch.me</a>
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                        <tr valign="center">
                                            <td align="left" style="padding: 16px 6.25%;">
                                                <a href="https://#SERVER_NAME#" target="_blank"><img width="60" alt="smerch" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/logo.png"></a>
                                            </td>
                                            <td align="right" style="padding: 16px 6.25%;">
                                                <p style="font-family: Tahoma, sans-serif; font-size: 10px; line-height: 14px; font-weight: 300; margin: 0;color: #8c8888;">
                                                    © 2017- 2021 СМЕРЧ г. Москва
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
',
            'BODY_TYPE' => 'html',
            'BCC' => '#BCC#',
            'REPLY_TO' => '',
            'CC' => '',
            'IN_REPLY_TO' => '',
            'PRIORITY' => '',
            'FIELD1_NAME' => '',
            'FIELD1_VALUE' => '',
            'FIELD2_NAME' => '',
            'FIELD2_VALUE' => '',
            'SITE_TEMPLATE_ID' => '',
            'ADDITIONAL_FIELD' => [],
            'LANGUAGE_ID' => '',
            'EVENT_TYPE' => '[ SALE_ORDER_PAID ] Заказ оплачен',
        ]);

        $helper->Event()->deleteEventMessage(['EVENT_NAME' => 'SALE_ORDER_TRACKING_NUMBER', 'SUBJECT' => '#SITE_NAME#: ЗАКАЗ N#ORDER_ID#']);
        $helper->Event()->deleteEventMessage(['EVENT_NAME' => 'SALE_ORDER_TRACKING_NUMBER', 'SUBJECT' => '#SITE_NAME#: ЗАКАЗ N#ORDER_ID#']);
        $helper->Event()->saveEventMessage('SALE_ORDER_TRACKING_NUMBER', [
            'LID' => ['s1'],
            'ACTIVE' => 'Y',
            'EMAIL_FROM' => '#SALE_EMAIL#',
            'EMAIL_TO' => '#EMAIL#',
            'SUBJECT' => '#SITE_NAME#: ЗАКАЗ N#ORDER_ID# ДОСТАВЛЯЕТСЯ',
            'MESSAGE' => '<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" style="background-color: #fff;">
<tbody>
<tr>
	<td align="center">
		<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; overflow: hidden;">
		<tbody>
		<tr>
			<td style="padding-top: 20px; padding-bottom: 20px;">
				<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" style="border-bottom: 1px solid #8c8888;">
				<tbody>
				<tr>
					<td align="left" style="padding-left: 6.25%; padding-bottom: 20px;">
						<a href="https://#SERVER_NAME#" target="_blank"><img width="60" alt="smerch" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/logo.png"></a>
					</td>
					<td align="right" style="padding-right: 6.25%; padding-bottom: 20px;">
						<a href="#" target="_blank" style="font-family: Tahoma, sans-serif; font-weight: 300; font-size: 12px; line-height: 16px; color: #000; text-align: right; text-decoration: none;">Открыть в браузере</a>
					</td>
				</tr>
				</tbody>
				</table>
				<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
				<tr>
					<td style="padding-top: 25px; padding-left: 6.25%; padding-right: 6.25%; padding-bottom: 40px;">
						<p style="margin-top: 0; margin-bottom: 24px; font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;">
							 #ORDER_USER#, мы передали ваш <a href="https://#SERVER_NAME#/personal/orders/#ORDER_ACCOUNT_NUMBER_ENCODE#" style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;color: #000;">заказ №#ORDER_ID#</a> в курьерскую службу DPD.
						</p>
						<p style="margin-top: 22px; margin-bottom: 16px; font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;">
							 Трек-номер вашего заказа:
						</p>
						<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
						<tr>
							<td style="padding: 18px 10px">
								<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: auto;">
								<tbody>
								<tr>
									<td align="center">
										<p style="font-family: Tahoma, sans-serif; font-size: 18px; line-height: 24px; font-weight: 300; margin: 0, text-transform: uppercase; margin:0;">
											 #ORDER_TRACKING_NUMBER#
										</p>
									</td>
								</tr>
								</tbody>
								</table>
							</td>
						</tr>
						</tbody>
						</table>
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin-top: 13px;">
							 Вы можете отследить его статус на сайте <a href="https://www.dpd.ru" style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;color: #000;">https://www.dpd.ru</a>
						</p>
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="https://www.dpd.ru" target="_blank" style="text-decoration: none; font-family: Tahoma, sans-serif; font-size: 12px; line-height: 36px; text-align: center; font-weight: 300; color: #FFFFFF; text-transform: uppercase; width: 260px; height: 36px; background-color: #000; display: block;">перейти на сайт DPD</a>
					</td>
				</tr>
				<tr>
					<td style="padding: 0 6.25%;">
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 30px 0;">
							 Когда курьер будет готов доставить ваш заказ – он обязательно свяжется с вами по указанному при оформлении заказа телефону.
						</p>
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
							Это письмо отправлено автоматически, но если у вас есть вопросы по заказу - задайте нам их в ответ на это письмо, и мы обязательно ответим в течение рабочего дня.
						</p>
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
							 Мы работаем пн-пт с 10.00 до 19.00.
						</p>
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
							 СМЕРЧ <br>
							&lt;3
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<table role="presentation" aria-hidden="true" cellpadding="0" cellspacing="0" width="100%">
						<tbody style="border-top: 1px solid #8c8888; border-bottom: 1px solid #8c8888">
						<tr>
							<td style="padding: 28px 0 28px 6.25%;">
								<p style="margin: 0; text-align: center; width: 63px">
									<img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/planet.png"><br>
									<a href="https://#SERVER_NAME#" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">smerch.me</a>
								</p>
							</td>
							<td style="padding: 28px 0; text-align: center;">
								<p style="margin: 0 auto; width: 121px;">
									<img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/mail.png"><br>
									<a href="mailto:order@smerch.me" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">order@smerch.me</a>
								</p>
							</td>
							<td style="padding: 28px 6.25% 28px 0; text-align: center;" align="right">
								<p style="margin: 0 0 0 auto; width: 67px;">
									<img alt="planet" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/insta.png"><br>
									<a href="https://www.instagram.com/smerch.me/" style="font-family: Arial, sans-serif; font-size: 12px; line-height: 16px; font-weight: 300; color: #000; text-decoration: none;">smerch.me</a>
								</p>
							</td>
						</tr>
						</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table role="presentation" aria-hidden="true" align="center" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
						<tr valign="center">
							<td align="left" style="padding: 16px 6.25%;">
								<a href="https://#SERVER_NAME#" target="_blank"><img width="60" alt="smerch" src="https://#SERVER_NAME#/local/templates/smerch/assets/img/mail/logo.png"></a>
							</td>
							<td align="right" style="padding: 16px 6.25%;">
								<p style="font-family: Tahoma, sans-serif; font-size: 10px; line-height: 14px; font-weight: 300; margin: 0;color: #8c8888;">
									 © 2017- 2021 СМЕРЧ г. Москва
								</p>
							</td>
						</tr>
						</tbody>
						</table>
					</td>
				</tr>
				</tbody>
				</table>
			</td>
		</tr>
		</tbody>
		</table>
	</td>
</tr>
</tbody>
</table>',
            'BODY_TYPE' => 'html',
            'BCC' => '',
            'REPLY_TO' => '',
            'CC' => '',
            'IN_REPLY_TO' => '',
            'PRIORITY' => '',
            'FIELD1_NAME' => '',
            'FIELD1_VALUE' => '',
            'FIELD2_NAME' => '',
            'FIELD2_VALUE' => '',
            'SITE_TEMPLATE_ID' => '',
            'ADDITIONAL_FIELD' => [],
            'LANGUAGE_ID' => '',
            'EVENT_TYPE' => '[ SALE_ORDER_TRACKING_NUMBER ] Уведомление об изменении идентификатора почтового отправления',
        ]);

        $helper->Event()->deleteEventMessage(['EVENT_NAME' => 'ORDER_PAID_ADMIN', 'SUBJECT' => 'Новый заказ']);
        $helper->Event()->deleteEventType(['LID' => 's1', 'EVENT_NAME' => 'ORDER_PAID_ADMIN']);
        $helper->Event()->saveEventMessage('SALE_ORDER_PAID', array(
            'LID' =>
                array(
                    0 => 's1',
                ),
            'ACTIVE' => 'Y',
            'EMAIL_FROM' => '#SALE_EMAIL#',
            'EMAIL_TO' => 'order@smerch.me',
            'SUBJECT' => 'Новый заказ',
            'MESSAGE' => 'Привет, пришел новый заказ))<br>
 <br>
 Номер заказа: #ORDER_REAL_ID#<br>
 Дата заказа: #ORDER_DATE#<br>
 Сумма заказа: #TOTAL_SUM#<br>
 <br>
 Состав заказа:<br>
 #ORDER_LIST#<br>
 <br>
 Покупатель: #ORDER_USER#<br>
 Emai покупателя: #EMAIL#<br>
 <br>
Письмо сгенерировано автоматически, йоу)',
            'BODY_TYPE' => 'html',
            'BCC' => '',
            'REPLY_TO' => '',
            'CC' => 'manych@smerch.me',
            'IN_REPLY_TO' => '',
            'PRIORITY' => '',
            'FIELD1_NAME' => '',
            'FIELD1_VALUE' => '',
            'FIELD2_NAME' => '',
            'FIELD2_VALUE' => '',
            'SITE_TEMPLATE_ID' => '',
            'ADDITIONAL_FIELD' =>
                array(),
            'LANGUAGE_ID' => '',
            'EVENT_TYPE' => '[ ORDER_PAID_ADMIN ] Заказ оплачен (для администратора)',
        ));
    }
}
