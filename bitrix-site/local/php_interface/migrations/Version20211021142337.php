<?php

namespace Sprint\Migration;


class Version20211021142337 extends Version
{
    protected $description = "Свойство показа товара в модалке в корзине";

    protected $moduleVersion = "3.29.5";

    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('poshtuchno', 'catalog');
        $helper->Iblock()->saveProperty($iblockId, array(
            'NAME' => 'Показывать в корзине',
            'ACTIVE' => 'Y',
            'SORT' => '500',
            'CODE' => 'BASKET_POPUP',
            'DEFAULT_VALUE' => '',
            'PROPERTY_TYPE' => 'L',
            'ROW_COUNT' => '1',
            'COL_COUNT' => '30',
            'LIST_TYPE' => 'C',
            'MULTIPLE' => 'N',
            'XML_ID' => null,
            'FILE_TYPE' => '',
            'MULTIPLE_CNT' => '5',
            'LINK_IBLOCK_ID' => '0',
            'WITH_DESCRIPTION' => 'N',
            'SEARCHABLE' => 'N',
            'FILTRABLE' => 'N',
            'IS_REQUIRED' => 'N',
            'VERSION' => '2',
            'USER_TYPE' => null,
            'USER_TYPE_SETTINGS' => null,
            'HINT' => '',
            'VALUES' =>
                array(
                    0 =>
                        array(
                            'VALUE' => 'Y',
                            'DEF' => 'N',
                            'SORT' => '500',
                            'XML_ID' => 'Y',
                        ),
                ),
            'FEATURES' =>
                array(
                    0 =>
                        array(
                            'MODULE_ID' => 'catalog',
                            'FEATURE_ID' => 'IN_BASKET',
                            'IS_ENABLED' => 'N',
                        ),
                    1 =>
                        array(
                            'MODULE_ID' => 'iblock',
                            'FEATURE_ID' => 'DETAIL_PAGE_SHOW',
                            'IS_ENABLED' => 'N',
                        ),
                    2 =>
                        array(
                            'MODULE_ID' => 'iblock',
                            'FEATURE_ID' => 'LIST_PAGE_SHOW',
                            'IS_ENABLED' => 'N',
                        ),
                ),
        ));
        $helper->UserOptions()->saveElementForm($iblockId, array(
            'Элемент|edit1' =>
                array(
                    'ID' => 'ID',
                    'DATE_CREATE' => 'Создан',
                    'TIMESTAMP_X' => 'Изменен',
                    'ACTIVE' => 'Активность',
                    'ACTIVE_FROM' => 'Начало активности',
                    'ACTIVE_TO' => 'Окончание активности',
                    'NAME' => 'Название',
                    'CODE' => 'Символьный код',
                    'SORT' => 'Сортировка',
                    'IBLOCK_ELEMENT_PROP_VALUE' => 'Значения свойств',
                    'PROPERTY_COMPOSITION' => 'Состав',
                    'PROPERTY_DELIVERY' => 'Доставка',
                    'PROPERTY_EXTRA' => 'Дополнительно',
                    'PROPERTY_MORE_PHOTO' => 'Доп. фото',
                    'PROPERTY_SIZES_TYPE' => 'Тип размера',
                    'PROPERTY_BASKET_POPUP' => 'Показывать в корзине',
                ),
            'Анонс|edit5' =>
                array(
                    'PREVIEW_PICTURE' => 'Картинка для анонса',
                    'PREVIEW_TEXT' => 'Описание для анонса',
                ),
            'Подробно|edit6' =>
                array(
                    'DETAIL_PICTURE' => 'Детальная картинка',
                    'DETAIL_TEXT' => 'Детальное описание',
                ),
            'SEO|edit14' =>
                array(
                    'IPROPERTY_TEMPLATES_ELEMENT_META_TITLE' => 'Шаблон META TITLE',
                    'IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS' => 'Шаблон META KEYWORDS',
                    'IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION' => 'Шаблон META DESCRIPTION',
                    'IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE' => 'Заголовок элемента',
                    'IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE' => 'Настройки для картинок анонса элементов',
                    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT' => 'Шаблон ALT',
                    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                    'IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE' => 'Настройки для детальных картинок элементов',
                    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT' => 'Шаблон ALT',
                    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                    'SEO_ADDITIONAL' => 'Дополнительно',
                    'TAGS' => 'Теги',
                ),
            'Торговые предложения|edit8' =>
                array(
                    'OFFERS' => 'Торговые предложения',
                ),
        ));
        $helper->UserOptions()->saveElementGrid($iblockId, array(
            'views' =>
                array(
                    'default' =>
                        array(
                            'columns' =>
                                array(
                                    0 => '',
                                ),
                            'columns_sizes' =>
                                array(
                                    'expand' => 1,
                                    'columns' =>
                                        array(),
                                ),
                            'sticked_columns' =>
                                array(),
                        ),
                ),
            'filters' =>
                array(),
            'current_view' => 'default',
        ));
        $helper->UserOptions()->saveSectionGrid($iblockId, array(
            'views' =>
                array(
                    'default' =>
                        array(
                            'columns' =>
                                array(
                                    0 => '',
                                ),
                            'columns_sizes' =>
                                array(
                                    'expand' => 1,
                                    'columns' =>
                                        array(),
                                ),
                            'sticked_columns' =>
                                array(),
                        ),
                ),
            'filters' =>
                array(),
            'current_view' => 'default',
        ));
    }

    public function down()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('poshtuchno', 'catalog');
        $helper->Iblock()->deletePropertyIfExists($iblockId, 'BASKET_POPUP');
        $helper->UserOptions()->saveElementForm($iblockId, array(
            'Элемент|edit1' =>
                array(
                    'ID' => 'ID',
                    'DATE_CREATE' => 'Создан',
                    'TIMESTAMP_X' => 'Изменен',
                    'ACTIVE' => 'Активность',
                    'ACTIVE_FROM' => 'Начало активности',
                    'ACTIVE_TO' => 'Окончание активности',
                    'NAME' => 'Название',
                    'CODE' => 'Символьный код',
                    'SORT' => 'Сортировка',
                    'IBLOCK_ELEMENT_PROP_VALUE' => 'Значения свойств',
                    'PROPERTY_COMPOSITION' => 'Состав',
                    'PROPERTY_DELIVERY' => 'Доставка',
                    'PROPERTY_EXTRA' => 'Дополнительно',
                    'PROPERTY_MORE_PHOTO' => 'Доп. фото',
                    'PROPERTY_SIZES_TYPE' => 'Тип размера',
                ),
            'Анонс|edit5' =>
                array(
                    'PREVIEW_PICTURE' => 'Картинка для анонса',
                    'PREVIEW_TEXT' => 'Описание для анонса',
                ),
            'Подробно|edit6' =>
                array(
                    'DETAIL_PICTURE' => 'Детальная картинка',
                    'DETAIL_TEXT' => 'Детальное описание',
                ),
            'SEO|edit14' =>
                array(
                    'IPROPERTY_TEMPLATES_ELEMENT_META_TITLE' => 'Шаблон META TITLE',
                    'IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS' => 'Шаблон META KEYWORDS',
                    'IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION' => 'Шаблон META DESCRIPTION',
                    'IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE' => 'Заголовок элемента',
                    'IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE' => 'Настройки для картинок анонса элементов',
                    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT' => 'Шаблон ALT',
                    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                    'IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE' => 'Настройки для детальных картинок элементов',
                    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT' => 'Шаблон ALT',
                    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                    'SEO_ADDITIONAL' => 'Дополнительно',
                    'TAGS' => 'Теги',
                ),
            'Торговые предложения|edit8' =>
                array(
                    'OFFERS' => 'Торговые предложения',
                ),
        ));
        $helper->UserOptions()->saveElementGrid($iblockId, array(
            'views' =>
                array(
                    'default' =>
                        array(
                            'columns' =>
                                array(
                                    0 => '',
                                ),
                            'columns_sizes' =>
                                array(
                                    'expand' => 1,
                                    'columns' =>
                                        array(),
                                ),
                            'sticked_columns' =>
                                array(),
                        ),
                ),
            'filters' =>
                array(),
            'current_view' => 'default',
        ));
        $helper->UserOptions()->saveSectionGrid($iblockId, array(
            'views' =>
                array(
                    'default' =>
                        array(
                            'columns' =>
                                array(
                                    0 => '',
                                ),
                            'columns_sizes' =>
                                array(
                                    'expand' => 1,
                                    'columns' =>
                                        array(),
                                ),
                            'sticked_columns' =>
                                array(),
                        ),
                ),
            'filters' =>
                array(),
            'current_view' => 'default',
        ));
    }
}
