<?php

namespace Sprint\Migration;


use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Sale\Internals\EO_Status_Collection;
use Bitrix\Sale\Internals\StatusLangTable;
use Bitrix\Sale\Internals\StatusTable;
use Exception;

class Version20210608091543 extends Version
{
    protected $description = "Статусы заказов";
    protected $moduleVersion = "3.28.7";
    
    private EO_Status_Collection $statuses;
    
    public function __construct()
    {
        Loader::includeModule('sale');
        $this->statuses = StatusTable::getList(['filter' => ['=TYPE' => 'O']])->fetchCollection();
    }
    
    /**
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Bitrix\Main\ArgumentOutOfRangeException
     * @throws \Bitrix\Main\ArgumentException
     */
    public function up()
    {
        $status = [
            'NOTIFY' => false,
            'SORT' => 100
        ];
        $lang = [
            'NAME' => 'Ожидает оплаты',
            'DESCRIPTION' => 'Заказ не оплачен, необходимо оплатить'
        ];
        $this->setStatus('N', $status, $lang);
        
        $status = [
            'NOTIFY' => true,
            'SORT' => 110
        ];
        $lang = [
            'NAME' => 'Оплачен',
            'DESCRIPTION' => ''
        ];
        $this->setStatus('P', $status, $lang);
        
        $status = [
            'NOTIFY' => true,
            'SORT' => 120
        ];
        $lang = [
            'NAME' => 'Комплектуется',
            'DESCRIPTION' => ''
        ];
        $this->setStatus('K', $status, $lang);
        
        $status = [
            'NOTIFY' => true,
            'SORT' => 130
        ];
        $lang = [
            'NAME' => 'Передан в доставку',
            'DESCRIPTION' => ''
        ];
        $this->setStatus('D', $status, $lang);
        
        $status = [
            'NOTIFY' => true,
            'SORT' => 200
        ];
        $lang = [
            'NAME' => 'Доставлен',
            'DESCRIPTION' => 'Доставлен #DATE#'
        ];
        $this->setStatus('F', $status, $lang);
        
        $status = [
            'NOTIFY' => false,
            'SORT' => 200
        ];
        $lang = [
            'NAME' => 'Отменён',
            'DESCRIPTION' => ''
        ];
        $this->setStatus('C', $status, $lang);
    }
    
    /**
     * @throws \Bitrix\Main\SystemException
     * @throws \Exception
     */
    public function down()
    {
        $connection = Application::getConnection();
        $connection->startTransaction();
        try {
            foreach ($this->statuses as $status) {
                if (! in_array($status->getId(), ['N', 'F'])) {
                    StatusTable::delete($status->primary);
                    StatusLangTable::delete(['STATUS_ID' => $status->getId(), 'LID' => 'ru']);
                    StatusLangTable::delete(['STATUS_ID' => $status->getId(), 'LID' => 'en']);
                }
            }
            $connection->commitTransaction();
        } catch (Exception $e) {
            $connection->rollbackTransaction();
            throw $e;
        }
    }
    
    /**
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Bitrix\Main\ArgumentOutOfRangeException
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Exception
     */
    private function setStatus(string $primary, array $statusFields, array $statusLangFields): void
    {
        $connection = Application::getConnection();
        $connection->startTransaction();
        try {
            if ($this->statuses->getByPrimary($primary)) {
                StatusTable::update($primary, $statusFields);
                StatusLangTable::update(['STATUS_ID' => $primary, 'LID' => 'ru'], $statusLangFields);
                StatusLangTable::update(['STATUS_ID' => $primary, 'LID' => 'en'], $statusLangFields);
            } else {
                StatusTable::add(array_merge(['ID' => $primary], $statusFields));
                StatusLangTable::add(array_merge(['STATUS_ID' => $primary, 'LID' => 'ru'], $statusLangFields));
                StatusLangTable::add(array_merge(['STATUS_ID' => $primary, 'LID' => 'en'], $statusLangFields));
            }
            $connection->commitTransaction();
        } catch (Exception $e) {
            $connection->rollbackTransaction();
            throw $e;
        }
    }
}
