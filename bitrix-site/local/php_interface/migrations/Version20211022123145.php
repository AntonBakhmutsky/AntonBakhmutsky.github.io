<?php

namespace Sprint\Migration;


class Version20211022123145 extends Version
{
    protected $description = "Таблица цветов товара";

    protected $moduleVersion = "3.29.5";

    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock(array(
            'NAME' => 'ProductColors',
            'TABLE_NAME' => 'b_hlbd_productcolors',
            'LANG' =>
                array(
                    'ru' =>
                        array(
                            'NAME' => 'Цвета товаров',
                        ),
                    'en' =>
                        array(
                            'NAME' => 'Product Colors',
                        ),
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array(
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '200',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'Y',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array(
                    'SIZE' => 20,
                    'ROWS' => 1,
                    'REGEXP' => '',
                    'MIN_LENGTH' => 0,
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => null,
                ),
            'EDIT_FORM_LABEL' =>
                array(
                    'ru' => 'Название',
                ),
            'LIST_COLUMN_LABEL' =>
                array(
                    'ru' => 'Название',
                ),
            'LIST_FILTER_LABEL' =>
                array(
                    'ru' => 'Название',
                ),
            'ERROR_MESSAGE' =>
                array(
                    'ru' => null,
                ),
            'HELP_MESSAGE' =>
                array(
                    'ru' => null,
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array(
            'FIELD_NAME' => 'UF_SORT',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => '',
            'SORT' => '300',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array(
                    'SIZE' => 20,
                    'MIN_VALUE' => 0,
                    'MAX_VALUE' => 0,
                    'DEFAULT_VALUE' => 0,
                ),
            'EDIT_FORM_LABEL' =>
                array(
                    'ru' => 'Сортировка',
                ),
            'LIST_COLUMN_LABEL' =>
                array(
                    'ru' => 'Сортировка',
                ),
            'LIST_FILTER_LABEL' =>
                array(
                    'ru' => 'Сортировка',
                ),
            'ERROR_MESSAGE' =>
                array(
                    'ru' => null,
                ),
            'HELP_MESSAGE' =>
                array(
                    'ru' => null,
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array(
            'FIELD_NAME' => 'UF_XML_ID',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '400',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'Y',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array(
                    'SIZE' => 20,
                    'ROWS' => 1,
                    'REGEXP' => '',
                    'MIN_LENGTH' => 0,
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => null,
                ),
            'EDIT_FORM_LABEL' =>
                array(
                    'ru' => 'Внешний код',
                ),
            'LIST_COLUMN_LABEL' =>
                array(
                    'ru' => 'Внешний код',
                ),
            'LIST_FILTER_LABEL' =>
                array(
                    'ru' => 'Внешний код',
                ),
            'ERROR_MESSAGE' =>
                array(
                    'ru' => null,
                ),
            'HELP_MESSAGE' =>
                array(
                    'ru' => null,
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array(
            'FIELD_NAME' => 'UF_DESCRIPTION',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '600',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array(
                    'SIZE' => 20,
                    'ROWS' => 1,
                    'REGEXP' => '',
                    'MIN_LENGTH' => 0,
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => null,
                ),
            'EDIT_FORM_LABEL' =>
                array(
                    'ru' => 'Описание',
                ),
            'LIST_COLUMN_LABEL' =>
                array(
                    'ru' => 'Описание',
                ),
            'LIST_FILTER_LABEL' =>
                array(
                    'ru' => 'Описание',
                ),
            'ERROR_MESSAGE' =>
                array(
                    'ru' => null,
                ),
            'HELP_MESSAGE' =>
                array(
                    'ru' => null,
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array(
            'FIELD_NAME' => 'UF_FULL_DESCRIPTION',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '700',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array(
                    'SIZE' => 20,
                    'ROWS' => 1,
                    'REGEXP' => '',
                    'MIN_LENGTH' => 0,
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => null,
                ),
            'EDIT_FORM_LABEL' =>
                array(
                    'ru' => 'Полное описание',
                ),
            'LIST_COLUMN_LABEL' =>
                array(
                    'ru' => 'Полное описание',
                ),
            'LIST_FILTER_LABEL' =>
                array(
                    'ru' => 'Полное описание',
                ),
            'ERROR_MESSAGE' =>
                array(
                    'ru' => null,
                ),
            'HELP_MESSAGE' =>
                array(
                    'ru' => null,
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array(
            'FIELD_NAME' => 'UF_DEF',
            'USER_TYPE_ID' => 'boolean',
            'XML_ID' => '',
            'SORT' => '800',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array(
                    'DEFAULT_VALUE' => 0,
                    'DISPLAY' => 'CHECKBOX',
                    'LABEL' =>
                        array(
                            0 => null,
                            1 => null,
                        ),
                    'LABEL_CHECKBOX' => null,
                ),
            'EDIT_FORM_LABEL' =>
                array(
                    'ru' => 'По умолчанию',
                ),
            'LIST_COLUMN_LABEL' =>
                array(
                    'ru' => 'По умолчанию',
                ),
            'LIST_FILTER_LABEL' =>
                array(
                    'ru' => 'По умолчанию',
                ),
            'ERROR_MESSAGE' =>
                array(
                    'ru' => null,
                ),
            'HELP_MESSAGE' =>
                array(
                    'ru' => null,
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array(
            'FIELD_NAME' => 'UF_FILE',
            'USER_TYPE_ID' => 'file',
            'XML_ID' => '',
            'SORT' => '900',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array(
                    'SIZE' => 20,
                    'LIST_WIDTH' => 50,
                    'LIST_HEIGHT' => 50,
                    'MAX_SHOW_SIZE' => 0,
                    'MAX_ALLOWED_SIZE' => 0,
                    'EXTENSIONS' =>
                        array(),
                    'TARGET_BLANK' => 'Y',
                ),
            'EDIT_FORM_LABEL' =>
                array(
                    'en' => '',
                    'ru' => 'Изображение',
                ),
            'LIST_COLUMN_LABEL' =>
                array(
                    'en' => '',
                    'ru' => 'Изображение',
                ),
            'LIST_FILTER_LABEL' =>
                array(
                    'en' => '',
                    'ru' => 'Изображение',
                ),
            'ERROR_MESSAGE' =>
                array(
                    'en' => '',
                    'ru' => '',
                ),
            'HELP_MESSAGE' =>
                array(
                    'en' => '',
                    'ru' => '',
                ),
        ));
    }

    public function down()
    {
        $helper = $this->getHelperManager();
        $helper->Hlblock()->deleteHlblock($helper->Hlblock()->getHlblockId('ProductColors'));
    }
}
