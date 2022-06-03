<?php

namespace Sprint\Migration;


class Version20211018120118 extends Version
{
    protected $description = "Отправка сертификата на email";

    protected $moduleVersion = "3.29.5";

    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Event()->saveEventType('CERTIFICATE_PAID', array(
            'LID' => 'ru',
            'EVENT_TYPE' => 'email',
            'NAME' => 'Сертификат оплачен',
            'DESCRIPTION' => '#COUPON# - купон
#EMAIL# - e-mail',
            'SORT' => '150',
        ));
        $helper->Event()->saveEventType('CERTIFICATE_PAID', array(
            'LID' => 'en',
            'EVENT_TYPE' => 'email',
            'NAME' => 'Certificate was paid',
            'DESCRIPTION' => '#COUPON# - coupon
#EMAIL# - e-mail',
            'SORT' => '150',
        ));
        $helper->Event()->saveEventMessage('CERTIFICATE_PAID', array(
            'LID' => ['s1'],
            'ACTIVE' => 'Y',
            'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
            'EMAIL_TO' => '#EMAIL#',
            'SUBJECT' => 'Сертификат',
            'MESSAGE' => '#COUPON#',
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
        $helper = $this->getHelperManager();
        $helper->Event()->deleteEventMessage(['EVENT_NAME' => 'CERTIFICATE_PAID', 'SUBJECT' => 'Сертификат']);
        $helper->Event()->deleteEventType(['EVENT_NAME' => 'CERTIFICATE_PAID', 'LID' => 'ru']);
        $helper->Event()->deleteEventType(['EVENT_NAME' => 'CERTIFICATE_PAID', 'LID' => 'en']);
    }
}
