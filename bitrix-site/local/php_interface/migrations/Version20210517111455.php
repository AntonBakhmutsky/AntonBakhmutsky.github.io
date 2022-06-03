<?php

namespace Sprint\Migration;


class Version20210517111455 extends Version
{
    protected $description = "Размеры товаров";
    
    protected $moduleVersion = "3.28.3";
    
    /**
     * @return bool|void
     * @throws Exceptions\RestartException
     * @throws Exceptions\HelperException
     * @throws Exceptions\ExchangeException
     */
    public function up()
    {
        $this->getExchangeManager()
            ->HlblockElementsImport()
            ->setExchangeResource('hlblock_elements.xml')
            ->setLimit(20)
            ->execute(
                function ($item) {
                    $this->getHelperManager()
                        ->Hlblock()
                        ->addElement(
                            $item['hlblock_id'],
                            $item['fields']
                        );
                }
            );
    }
    
    public function down()
    {
        //your code ...
    }
}
