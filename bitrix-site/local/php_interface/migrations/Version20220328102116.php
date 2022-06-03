<?php

namespace Sprint\Migration;


class Version20220328102116 extends Version
{
    protected $description = "Статус для самовывоза";

    protected $moduleVersion = "4.0.2";

    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Event()->saveEventType('SALE_STATUS_CHANGED_D', array(
            'LID' => 'ru',
            'EVENT_TYPE' => 'email',
            'NAME' => 'Изменение статуса заказа на  "Принят в доставку"',
            'DESCRIPTION' => '#ORDER_ID# - код заказа
#ORDER_DATE# - дата заказа
#ORDER_STATUS# - статус заказа
#ORDER_USER# - заказчик
#EMAIL# - E-Mail пользователя
#ORDER_DESCRIPTION# - описание статуса заказа
#TEXT# - текст
#SALE_EMAIL# - E-Mail отдела продаж
#ORDER_PUBLIC_URL# - ссылка для просмотра заказа без авторизации (требуется настройка в модуле интернет-магазина)',
            'SORT' => '150',
        ));
        $helper->Event()->saveEventType('SALE_STATUS_CHANGED_D', array(
            'LID' => 'en',
            'EVENT_TYPE' => 'email',
            'NAME' => 'Changing order status to "Going to delivery"',
            'DESCRIPTION' => '#ORDER_ID# - order ID
#ORDER_DATE# - order date
#ORDER_STATUS# - order status
#ORDER_USER# - customer
#EMAIL# - customer e-mail
#ORDER_DESCRIPTION# - order status description
#TEXT# - text
#SALE_EMAIL# - Sales department e-mail
#ORDER_PUBLIC_URL# - order view link for unauthorized users (requires configuration in the e-Store module settings)',
            'SORT' => '150',
        ));
        $helper->Event()->saveEventMessage('SALE_STATUS_CHANGED_D', array(
            'LID' =>
                array(
                    0 => 's1',
                ),
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
							 #ORDER_USER#, Ваш <a href="https://#SERVER_NAME#/personal/orders/#ORDER_ACCOUNT_NUMBER_ENCODE#" style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300;color: #000;">заказ №#ORDER_ID#</a> готов к выдаче!
						</p>
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 20px 0;">
							 Если вы зарегистрированы у нас на сайте, то вы можете следить за статусом заказа у себя в личном кабинете. Когда статус заказа будет «передан в доставку» - это значит, что заказ готов к выдаче.
						</p>
					</td>
				</tr>
				<tr>
					<td style="padding: 0 6.25%;">
						<p style="font-family: Tahoma, sans-serif; font-size: 14px; line-height: 19px; font-weight: 300; margin: 30px 0;">
							 Забрать заказ можно с 10:30 до 18:30 (пн-пт) по адресу: Семеновская площадь, дом 7 (БЦ "Вэронд") Наш номер для связи: 8-995-899-55-63, желательно предупредить нас о визите любым удобным способом за 30 минут
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
</table>',
            'BODY_TYPE' => 'html',
            'BCC' => '',
            'REPLY_TO' => '',
            'CC' => '',
            'IN_REPLY_TO' => '',
            'PRIORITY' => '',
            'FIELD1_NAME' => 'type',
            'FIELD1_VALUE' => 'pickup',
            'FIELD2_NAME' => '',
            'FIELD2_VALUE' => '',
            'SITE_TEMPLATE_ID' => '',
            'ADDITIONAL_FIELD' =>
                array(
                    0 =>
                        array(
                            'NAME' => 'type',
                            'VALUE' => 'pickup',
                        ),
                ),
            'LANGUAGE_ID' => '',
            'EVENT_TYPE' => '[ SALE_STATUS_CHANGED_D ] Изменение статуса заказа на  "Принят в доставку"',
        ));
    }

    public function down()
    {
        $helper = $this->getHelperManager();
        $helper->Event()->deleteEventMessage(['EVENT_NAME' => 'SALE_STATUS_CHANGED_D', 'SUBJECT' => '#SITE_NAME#: ЗАКАЗ N#ORDER_ID# ДОСТАВЛЯЕТСЯ']);
        $helper->Event()->deleteEventType(['LID' => 's1', 'EVENT_NAME' => 'SALE_STATUS_CHANGED_D']);
    }
}
