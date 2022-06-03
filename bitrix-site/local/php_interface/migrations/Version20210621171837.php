<?php

namespace Sprint\Migration;


class Version20210621171837 extends Version
{
    protected $description = "Агент для удаления заказов";
    
    protected $moduleVersion = "3.28.7";
    
    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Agent()->saveAgent(
            [
                'MODULE_ID' => 'sale',
                'USER_ID' => null,
                'SORT' => '100',
                'NAME' => '\\ITLeague\\Order::deleteUnpaidOrders();',
                'ACTIVE' => 'Y',
                'NEXT_EXEC' => '21.06.2021 00:00:00',
                'AGENT_INTERVAL' => '3600',
                'IS_PERIOD' => 'N',
                'RETRY_COUNT' => null,
            ]
        );
    }
    
    public function down()
    {
        $helper = $this->getHelperManager();
        $helper->Agent()->deleteAgent('sale', '\\ITLeague\\Order::deleteUnpaidOrders();');
    }
}
