<?php

namespace Sprint\Migration;


class Version20211217133637 extends Version
{
    protected $description = "Текст письма с сертификатом";

    protected $moduleVersion = "3.29.5";

    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Event()->saveEventType('CERTIFICATE_PAID', array(
            'LID' => 'ru',
            'EVENT_TYPE' => 'email',
            'NAME' => 'Сертификат оплачен',
            'DESCRIPTION' => '#COUPON# - купон
#USER# - имя пользователя
#RATING# - номинал сертификата
#EMAIL# - e-mail',
            'SORT' => '150',
        ));
        $helper->Event()->saveEventType('CERTIFICATE_PAID', array(
            'LID' => 'en',
            'EVENT_TYPE' => 'email',
            'NAME' => 'Certificate was paid',
            'DESCRIPTION' => '#COUPON# - coupon       
#USER# - user name
#RATING# - certificate rating
#EMAIL# - e-mail',
            'SORT' => '150',
        ));
        $helper->Event()->saveEventMessage('CERTIFICATE_PAID', array(
            'LID' => ['s1'],
            'ACTIVE' => 'Y',
            'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
            'EMAIL_TO' => '#EMAIL#',
            'SUBJECT' => 'Сертификат',
            'MESSAGE' => '#USER#, спасибо за заказ сертификата <3

Сертификат на сумму #RATING# успешно оплачен.

Сертификатом можно полностью или частично оплатить заказ у нас в интернет-магазине smerch.me
Сертификат действует на любые товары из разделов КОЛЛАБЫ и ПОШТУЧНО.

Чтобы воспользоваться сертификатом, просто введите его код при оформлении заказа.

Промокод действует 90 дней с момента покупки сертификата.

Если вы хотите подарить сертификат, то вы можете или отправить картинку с индивидуальным промокодом из этого письма, или распечатать эту картинку (для удобства мы сделали её в формате А4), или переслать это письмо тому, кому хотите сделать подарок, или просто скопировать промокод и отправить его любым удобным способом получателю подарка.

Промокод: #COUPON#

Спасибо, что вы с нами!

СМЕРЧ
<3',
            'BODY_TYPE' => 'text',
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
            'EVENT_TYPE' => '[ CERTIFICATE_PAID ] Сертификат оплачен',
        ));
    }

    public function down()
    {
        //your code ...
    }
}
