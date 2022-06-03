<?php
namespace ITLeague\Subscription;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields;

Loc::loadMessages(__FILE__);

/**
 * Class RubricTable
 *
 * Fields:
 * <ul>
 * <li> SUBSCRIPTION_ID int mandatory
 * <li> LIST_RUBRIC_ID int mandatory
 * <li> LIST_RUBRIC_ID reference to {@link \Bitrix\List\ListRubricTable}
 * <li> SUBSCRIPTION_ID reference to {@link \Bitrix\Subscription\SubscriptionTable}
 * </ul>
 *
 * @package ITLeague\Subscription
 **/

class SubscriptionRubricTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return 'b_subscription_rubric';
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
            (new Fields\IntegerField('SUBSCRIPTION_ID',
                                     []
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_SUBSCRIPTION_ID_FIELD'))
                ->configurePrimary(true),
            (new Fields\IntegerField('LIST_RUBRIC_ID',
                                     []
            ))->configureTitle(Loc::getMessage('RUBRIC_ENTITY_LIST_RUBRIC_ID_FIELD'))
                ->configurePrimary(true),
            new Fields\Relations\Reference(
                'LIST_RUBRIC',
                '\ITLeague\Subscription\ListRubric',
                ['=this.LIST_RUBRIC_ID' => 'ref.ID'],
                ['join_type' => 'LEFT']
            ),
            new Fields\Relations\Reference(
                'SUBSCRIPTION',
                '\Bitrix\Subscription\Subscription',
                ['=this.SUBSCRIPTION_ID' => 'ref.ID'],
                ['join_type' => 'LEFT']
            ),
        ];
    }
}
