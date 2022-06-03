<?php

namespace ITLeague\Subscription;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\TextField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

Loc::loadMessages(__FILE__);

/**
 * Class RubricTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> LID string(2) mandatory
 * <li> CODE string(100) optional
 * <li> NAME string(100) optional
 * <li> DESCRIPTION text optional
 * <li> SORT int optional default 100
 * <li> ACTIVE bool ('N', 'Y') optional default 'Y'
 * <li> AUTO bool ('N', 'Y') optional default 'N'
 * <li> DAYS_OF_MONTH string(100) optional
 * <li> DAYS_OF_WEEK string(15) optional
 * <li> TIMES_OF_DAY string(255) optional
 * <li> TEMPLATE string(100) optional
 * <li> LAST_EXECUTED datetime optional
 * <li> VISIBLE bool ('N', 'Y') optional default 'Y'
 * <li> FROM_FIELD string(255) optional
 * <li> LID reference to {@link \Bitrix\Lang\LangTable}
 * </ul>
 *
 * @package ITLeague\Subscription
 **/
class ListRubricTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return 'b_list_rubric';
    }
    
    /**
     * Returns entity map definition.
     *
     * @return array
     * @throws \Bitrix\Main\SystemException
     */
    public static function getMap(): array
    {
        return [
            (new IntegerField(
                'ID',
                []
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_ID_FIELD'))
                ->configurePrimary(true)
                ->configureAutocomplete(true),
            (new StringField(
                'LID',
                [
                    'validation' => [__CLASS__, 'validateLid']
                ]
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_LID_FIELD'))
                ->configureRequired(true),
            (new StringField(
                'CODE',
                [
                    'validation' => [__CLASS__, 'validateCode']
                ]
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_CODE_FIELD')),
            (new StringField(
                'NAME',
                [
                    'validation' => [__CLASS__, 'validateName']
                ]
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_NAME_FIELD')),
            (new TextField(
                'DESCRIPTION',
                []
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_DESCRIPTION_FIELD')),
            (new IntegerField(
                'SORT',
                []
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_SORT_FIELD'))
                ->configureDefaultValue(100),
            (new BooleanField(
                'ACTIVE',
                []
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_ACTIVE_FIELD'))
                ->configureValues('N', 'Y')
                ->configureDefaultValue('Y'),
            (new BooleanField(
                'AUTO',
                []
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_AUTO_FIELD'))
                ->configureValues('N', 'Y')
                ->configureDefaultValue('N'),
            (new StringField(
                'DAYS_OF_MONTH',
                [
                    'validation' => [__CLASS__, 'validateDaysOfMonth']
                ]
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_DAYS_OF_MONTH_FIELD')),
            (new StringField(
                'DAYS_OF_WEEK',
                [
                    'validation' => [__CLASS__, 'validateDaysOfWeek']
                ]
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_DAYS_OF_WEEK_FIELD')),
            (new StringField(
                'TIMES_OF_DAY',
                [
                    'validation' => [__CLASS__, 'validateTimesOfDay']
                ]
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_TIMES_OF_DAY_FIELD')),
            (new StringField(
                'TEMPLATE',
                [
                    'validation' => [__CLASS__, 'validateTemplate']
                ]
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_TEMPLATE_FIELD')),
            (new DatetimeField(
                'LAST_EXECUTED',
                []
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_LAST_EXECUTED_FIELD')),
            (new BooleanField(
                'VISIBLE',
                []
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_VISIBLE_FIELD'))
                ->configureValues('N', 'Y')
                ->configureDefaultValue('Y'),
            (new StringField(
                'FROM_FIELD',
                [
                    'validation' => [__CLASS__, 'validateFromField']
                ]
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_FROM_FIELD_FIELD')),
            new Reference(
                'LANG',
                '\Bitrix\Lang\Lang',
                ['=this.LID' => 'ref.LID'],
                ['join_type' => 'LEFT']
            ),
        ];
    }
    
    /**
     * Returns validators for LID field.
     *
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public static function validateLid(): array
    {
        return [
            new LengthValidator(null, 2),
        ];
    }
    
    /**
     * Returns validators for CODE field.
     *
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public static function validateCode(): array
    {
        return [
            new LengthValidator(null, 100),
        ];
    }
    
    /**
     * Returns validators for NAME field.
     *
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public static function validateName(): array
    {
        return [
            new LengthValidator(null, 100),
        ];
    }
    
    /**
     * Returns validators for DAYS_OF_MONTH field.
     *
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public static function validateDaysOfMonth(): array
    {
        return [
            new LengthValidator(null, 100),
        ];
    }
    
    /**
     * Returns validators for DAYS_OF_WEEK field.
     *
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public static function validateDaysOfWeek(): array
    {
        return [
            new LengthValidator(null, 15),
        ];
    }
    
    /**
     * Returns validators for TIMES_OF_DAY field.
     *
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public static function validateTimesOfDay(): array
    {
        return [
            new LengthValidator(null, 255),
        ];
    }
    
    /**
     * Returns validators for TEMPLATE field.
     *
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public static function validateTemplate(): array
    {
        return [
            new LengthValidator(null, 100),
        ];
    }
    
    /**
     * Returns validators for FROM_FIELD field.
     *
     * @throws \Bitrix\Main\ArgumentTypeException
     */
    public static function validateFromField(): array
    {
        return [
            new LengthValidator(null, 255),
        ];
    }
}
