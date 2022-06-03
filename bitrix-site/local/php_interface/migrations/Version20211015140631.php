<?php

namespace Sprint\Migration;


use ITLeague\Helpers\Iblock;

class Version20211015140631 extends Version
{
    protected $description = "Свойство \"Номинал\" торговых предложений";

    protected $moduleVersion = "3.28.7";

    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('poshtuchno_offers', 'offers');
        $helper->Iblock()->saveProperty($iblockId, array(
            'NAME' => 'Размер',
            'ACTIVE' => 'Y',
            'SORT' => '500',
            'CODE' => 'SIZE',
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
            'FILTRABLE' => 'Y',
            'IS_REQUIRED' => 'N',
            'VERSION' => '2',
            'USER_TYPE' => 'directory',
            'USER_TYPE_SETTINGS' =>
                array(
                    'size' => 1,
                    'width' => 0,
                    'group' => 'N',
                    'multiple' => 'N',
                    'TABLE_NAME' => 'b_hlbd_productsizes',
                ),
            'HINT' => '',
        ));
        $helper->Iblock()->saveProperty($iblockId, array(
            'NAME' => 'Номинал',
            'ACTIVE' => 'Y',
            'SORT' => '500',
            'CODE' => 'RATING',
            'DEFAULT_VALUE' => '',
            'PROPERTY_TYPE' => 'L',
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
            'USER_TYPE' => null,
            'USER_TYPE_SETTINGS' => null,
            'HINT' => '',
            'FEATURES' => [
                [
                    'IS_ENABLED' => 'Y',
                    'MODULE_ID' => 'iblock',
                    'FEATURE_ID' => 'DETAIL_PAGE_SHOW'
                ],
                [
                    'IS_ENABLED' => 'Y',
                    'MODULE_ID' => 'catalog',
                    'FEATURE_ID' => 'IN_BASKET'
                ],
                [
                    'IS_ENABLED' => 'Y',
                    'MODULE_ID' => 'catalog',
                    'FEATURE_ID' => 'OFFER_TREE'
                ]
            ],
            'VALUES' =>
                array(
                    0 =>
                        array(
                            'VALUE' => '2500 руб',
                            'DEF' => 'N',
                            'SORT' => '10',
                            'XML_ID' => '2500',
                        ),
                    1 =>
                        array(
                            'VALUE' => '5000 руб',
                            'DEF' => 'N',
                            'SORT' => '20',
                            'XML_ID' => '5000',
                        ),
                    2 =>
                        array(
                            'VALUE' => '7500 руб',
                            'DEF' => 'N',
                            'SORT' => '30',
                            'XML_ID' => '7500',
                        ),
                    3 =>
                        array(
                            'VALUE' => '10000 руб',
                            'DEF' => 'N',
                            'SORT' => '40',
                            'XML_ID' => '10000',
                        ),
                ),
        ));
    }

    public function down()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('poshtuchno_offers', 'offers');
        $helper->Iblock()->saveProperty($iblockId, array(
            'NAME' => 'Размер',
            'ACTIVE' => 'Y',
            'SORT' => '500',
            'CODE' => 'SIZE',
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
            'FILTRABLE' => 'Y',
            'IS_REQUIRED' => 'Y',
            'VERSION' => '2',
            'USER_TYPE' => 'directory',
            'USER_TYPE_SETTINGS' =>
                array(
                    'size' => 1,
                    'width' => 0,
                    'group' => 'N',
                    'multiple' => 'N',
                    'TABLE_NAME' => 'b_hlbd_productsizes',
                ),
            'HINT' => '',
        ));
        $helper->Iblock()->deletePropertyIfExists($iblockId, 'RATING');
    }
}
