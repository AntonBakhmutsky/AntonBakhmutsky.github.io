<?php

namespace Sprint\Migration;


class Version20210710080603 extends Version
{
    protected $description = "Тип изображений коллабов";
    
    protected $moduleVersion = "3.28.7";
    
    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('collabs', 'catalog');
        $helper->UserTypeEntity()->saveUserTypeEntity(
            [
                'ENTITY_ID' => "IBLOCK_{$iblockId}_SECTION",
                'FIELD_NAME' => 'UF_SHAPE_TYPE',
                'USER_TYPE_ID' => 'enumeration',
                'XML_ID' => '',
                'SORT' => '100',
                'MULTIPLE' => 'N',
                'MANDATORY' => 'Y',
                'SHOW_FILTER' => 'I',
                'SHOW_IN_LIST' => 'Y',
                'EDIT_IN_LIST' => 'Y',
                'IS_SEARCHABLE' => 'N',
                'SETTINGS' =>
                    [
                        'DISPLAY' => 'CHECKBOX',
                        'LIST_HEIGHT' => 3,
                        'CAPTION_NO_VALUE' => '',
                        'SHOW_NO_VALUE' => 'N',
                    ],
                'EDIT_FORM_LABEL' =>
                    [
                        'en' => '',
                        'ru' => 'Тип изображений раздела',
                    ],
                'LIST_COLUMN_LABEL' =>
                    [
                        'en' => '',
                        'ru' => 'Тип изображений раздела',
                    ],
                'LIST_FILTER_LABEL' =>
                    [
                        'en' => '',
                        'ru' => 'Тип изображений раздела',
                    ],
                'ERROR_MESSAGE' =>
                    [
                        'en' => '',
                        'ru' => '',
                    ],
                'HELP_MESSAGE' =>
                    [
                        'en' => '',
                        'ru' => '',
                    ],
                'ENUM_VALUES' =>
                    [
                        0 =>
                            [
                                'VALUE' => 'Горизонтальные',
                                'DEF' => 'N',
                                'SORT' => '500',
                                'XML_ID' => 'horizontal',
                            ],
                        1 =>
                            [
                                'VALUE' => 'Квадратные',
                                'DEF' => 'Y',
                                'SORT' => '500',
                                'XML_ID' => 'square',
                            ],
                        2 =>
                            [
                                'VALUE' => 'Вертикальные',
                                'DEF' => 'N',
                                'SORT' => '500',
                                'XML_ID' => 'vertical',
                            ],
                    ],
            ]
        );
        $helper->UserOptions()->saveSectionForm(
            $iblockId,
            [
                'Раздел|edit1' =>
                    [
                        'ID' => 'ID',
                        'DATE_CREATE' => 'Создан',
                        'TIMESTAMP_X' => 'Изменен',
                        'ACTIVE' => 'Раздел активен',
                        'UF_ARCHIVED' => 'Архив',
                        'IBLOCK_SECTION_ID' => 'Родительский раздел',
                        'SORT' => 'Сортировка',
                        'NAME' => 'Название',
                        'CODE' => 'Символьный код',
                        'PICTURE' => 'Изображение',
                        'UF_LOGO_1' => 'Лого 1',
                        'UF_LINK_1' => 'Ссылка лого 1',
                        'UF_LOGO_2' => 'Лого 2',
                        'UF_LINK_2' => 'Ссылка лого 2',
                        'UF_COLOR' => 'Цвет',
                        'UF_ITEMS_IN_RAW' => 'Элементов в ряду',
                        'UF_SHAPE_TYPE' => 'Тип изображений раздела',
                        'DESCRIPTION' => 'Описание',
                        'USER_FIELDS_ADD' => 'Добавить пользовательское свойство',
                    ],
                'SEO|edit5' =>
                    [
                        'IPROPERTY_TEMPLATES_SECTION' => 'Настройки для разделов',
                        'IPROPERTY_TEMPLATES_SECTION_META_TITLE' => 'Шаблон META TITLE',
                        'IPROPERTY_TEMPLATES_SECTION_META_KEYWORDS' => 'Шаблон META KEYWORDS',
                        'IPROPERTY_TEMPLATES_SECTION_META_DESCRIPTION' => 'Шаблон META DESCRIPTION',
                        'IPROPERTY_TEMPLATES_SECTION_PAGE_TITLE' => 'Заголовок раздела',
                        'IPROPERTY_TEMPLATES_ELEMENT' => 'Настройки для элементов',
                        'IPROPERTY_TEMPLATES_ELEMENT_META_TITLE' => 'Шаблон META TITLE',
                        'IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS' => 'Шаблон META KEYWORDS',
                        'IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION' => 'Шаблон META DESCRIPTION',
                        'IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE' => 'Заголовок товара',
                        'IPROPERTY_TEMPLATES_SECTIONS_PICTURE' => 'Настройки для изображений разделов',
                        'IPROPERTY_TEMPLATES_SECTION_PICTURE_FILE_ALT' => 'Шаблон ALT',
                        'IPROPERTY_TEMPLATES_SECTION_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                        'IPROPERTY_TEMPLATES_SECTION_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                        'IPROPERTY_TEMPLATES_SECTIONS_DETAIL_PICTURE' => 'Настройки для детальных картинок разделов',
                        'IPROPERTY_TEMPLATES_SECTION_DETAIL_PICTURE_FILE_ALT' => 'Шаблон ALT',
                        'IPROPERTY_TEMPLATES_SECTION_DETAIL_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                        'IPROPERTY_TEMPLATES_SECTION_DETAIL_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                        'IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE' => 'Настройки для картинок анонса элементов',
                        'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT' => 'Шаблон ALT',
                        'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                        'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                        'IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE' => 'Настройки для детальных картинок элементов',
                        'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT' => 'Шаблон ALT',
                        'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                        'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                        'IPROPERTY_TEMPLATES_MANAGEMENT' => 'Управление',
                        'IPROPERTY_CLEAR_VALUES' => 'Очистить кеш вычисленных значений',
                    ],
            ]
        );
    }
    
    public function down()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('collabs', 'catalog');
        $helper->UserOptions()->saveSectionForm(
            $iblockId,
            [
                'Раздел|edit1' =>
                    [
                        'ID' => 'ID',
                        'DATE_CREATE' => 'Создан',
                        'TIMESTAMP_X' => 'Изменен',
                        'ACTIVE' => 'Раздел активен',
                        'UF_ARCHIVED' => 'Архив',
                        'IBLOCK_SECTION_ID' => 'Родительский раздел',
                        'SORT' => 'Сортировка',
                        'NAME' => 'Название',
                        'CODE' => 'Символьный код',
                        'PICTURE' => 'Изображение',
                        'UF_LOGO_1' => 'Лого 1',
                        'UF_LINK_1' => 'Ссылка лого 1',
                        'UF_LOGO_2' => 'Лого 2',
                        'UF_LINK_2' => 'Ссылка лого 2',
                        'UF_COLOR' => 'Цвет',
                        'UF_ITEMS_IN_RAW' => 'Элементов в ряду',
                        'DESCRIPTION' => 'Описание',
                        'USER_FIELDS_ADD' => 'Добавить пользовательское свойство',
                    ],
                'SEO|edit5' =>
                    [
                        'IPROPERTY_TEMPLATES_SECTION' => 'Настройки для разделов',
                        'IPROPERTY_TEMPLATES_SECTION_META_TITLE' => 'Шаблон META TITLE',
                        'IPROPERTY_TEMPLATES_SECTION_META_KEYWORDS' => 'Шаблон META KEYWORDS',
                        'IPROPERTY_TEMPLATES_SECTION_META_DESCRIPTION' => 'Шаблон META DESCRIPTION',
                        'IPROPERTY_TEMPLATES_SECTION_PAGE_TITLE' => 'Заголовок раздела',
                        'IPROPERTY_TEMPLATES_ELEMENT' => 'Настройки для элементов',
                        'IPROPERTY_TEMPLATES_ELEMENT_META_TITLE' => 'Шаблон META TITLE',
                        'IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS' => 'Шаблон META KEYWORDS',
                        'IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION' => 'Шаблон META DESCRIPTION',
                        'IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE' => 'Заголовок товара',
                        'IPROPERTY_TEMPLATES_SECTIONS_PICTURE' => 'Настройки для изображений разделов',
                        'IPROPERTY_TEMPLATES_SECTION_PICTURE_FILE_ALT' => 'Шаблон ALT',
                        'IPROPERTY_TEMPLATES_SECTION_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                        'IPROPERTY_TEMPLATES_SECTION_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                        'IPROPERTY_TEMPLATES_SECTIONS_DETAIL_PICTURE' => 'Настройки для детальных картинок разделов',
                        'IPROPERTY_TEMPLATES_SECTION_DETAIL_PICTURE_FILE_ALT' => 'Шаблон ALT',
                        'IPROPERTY_TEMPLATES_SECTION_DETAIL_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                        'IPROPERTY_TEMPLATES_SECTION_DETAIL_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                        'IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE' => 'Настройки для картинок анонса элементов',
                        'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT' => 'Шаблон ALT',
                        'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                        'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                        'IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE' => 'Настройки для детальных картинок элементов',
                        'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT' => 'Шаблон ALT',
                        'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
                        'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME' => 'Шаблон имени файла',
                        'IPROPERTY_TEMPLATES_MANAGEMENT' => 'Управление',
                        'IPROPERTY_CLEAR_VALUES' => 'Очистить кеш вычисленных значений',
                    ],
            ]
        );
        $helper->UserTypeEntity()->deleteUserTypeEntityIfExists("IBLOCK_{$iblockId}_SECTION", 'UF_SHAPE_TYPE');
    }
}
