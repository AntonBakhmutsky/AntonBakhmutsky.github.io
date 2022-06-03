<?php

namespace Sprint\Migration;


class Version20211022123221 extends Version
{
    protected $description = "Добавление свойства ТП \"Цвет\"";

    protected $moduleVersion = "3.29.5";

    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('poshtuchno_offers', 'offers');
        $helper->Iblock()->saveProperty($iblockId, array(
            'NAME' => 'Цвет',
            'ACTIVE' => 'Y',
            'SORT' => '500',
            'CODE' => 'COLOR',
            'DEFAULT_VALUE' => '',
            'PROPERTY_TYPE' => 'S',
            'ROW_COUNT' => '1',
            'COL_COUNT' => '30',
            'LIST_TYPE' => 'L',
            'MULTIPLE' => 'N',
            'XML_ID' => null,
            'FILE_TYPE' => '',
            'MULTIPLE_CNT' => '5',
            'LINK_IBLOCK_ID' => '0',
            'WITH_DESCRIPTION' => 'N',
            'SEARCHABLE' => 'N',
            'FILTRABLE' => 'N',
            'IS_REQUIRED' => 'N',
            'VERSION' => '1',
            'USER_TYPE' => 'directory',
            'USER_TYPE_SETTINGS' =>
                array(
                    'size' => 1,
                    'width' => 0,
                    'group' => 'N',
                    'multiple' => 'N',
                    'TABLE_NAME' => 'b_hlbd_productcolors',
                ),
            'HINT' => '',
            'FEATURES' =>
                array(
                    0 =>
                        array(
                            'MODULE_ID' => 'catalog',
                            'FEATURE_ID' => 'IN_BASKET',
                            'IS_ENABLED' => 'Y',
                        ),
                    1 =>
                        array(
                            'MODULE_ID' => 'catalog',
                            'FEATURE_ID' => 'OFFER_TREE',
                            'IS_ENABLED' => 'Y',
                        ),
                    2 =>
                        array(
                            'MODULE_ID' => 'iblock',
                            'FEATURE_ID' => 'DETAIL_PAGE_SHOW',
                            'IS_ENABLED' => 'Y',
                        ),
                    3 =>
                        array(
                            'MODULE_ID' => 'iblock',
                            'FEATURE_ID' => 'LIST_PAGE_SHOW',
                            'IS_ENABLED' => 'N',
                        ),
                ),
        ));
    }

    public function down()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('poshtuchno_offers', 'offers');
        $helper->Iblock()->deletePropertyIfExists($iblockId, 'COLOR');
    }
}
