<?php

namespace Sprint\Migration;


class Version20210430125157 extends Version
{
    protected $description = "Свойство \"Цвет\" для инфоблоков";
    
    protected $moduleVersion = "3.28.3";
    
    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->UserTypeEntity()->saveUserTypeEntity(
            [
                'ENTITY_ID' => 'ASD_IBLOCK',
                'FIELD_NAME' => 'UF_COLOR',
                'USER_TYPE_ID' => 'string',
                'XML_ID' => '',
                'SORT' => '100',
                'MULTIPLE' => 'N',
                'MANDATORY' => 'N',
                'SHOW_FILTER' => 'N',
                'SHOW_IN_LIST' => 'Y',
                'EDIT_IN_LIST' => 'Y',
                'IS_SEARCHABLE' => 'N',
                'SETTINGS' =>
                    [
                        'SIZE' => 6,
                        'ROWS' => 1,
                        'REGEXP' => '',
                        'MIN_LENGTH' => 0,
                        'MAX_LENGTH' => 0,
                        'DEFAULT_VALUE' => '',
                    ],
                'EDIT_FORM_LABEL' =>
                    [
                        'en' => 'Color',
                        'ru' => 'Цвет',
                    ],
                'LIST_COLUMN_LABEL' =>
                    [
                        'en' => 'Color',
                        'ru' => 'Цвет',
                    ],
                'LIST_FILTER_LABEL' =>
                    [
                        'en' => 'Color',
                        'ru' => 'Цвет',
                    ],
                'ERROR_MESSAGE' =>
                    [
                        'en' => '',
                        'ru' => '',
                    ],
                'HELP_MESSAGE' =>
                    [
                        'en' => '#000000',
                        'ru' => '#000000',
                    ],
            ]
        );
    }
    
    public function down()
    {
        $helper = $this->getHelperManager();
        $helper->UserTypeEntity()->deleteUserTypeEntitiesIfExists('ASD_IBLOCK', ['UF_COLOR']);
    }
}
