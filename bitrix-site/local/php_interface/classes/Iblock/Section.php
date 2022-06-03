<?php


namespace ITLeague\Iblock;


use Bitrix\Iblock\EO_Section;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use CRubric;

class Section extends EO_Section
{
    /* @var \ITLeague\Iblock\SectionTable */
    static public $dataClass = '\ITLeague\Iblock\SectionTable';
    
    static private array $oldFields = [];
    
    public static function onAfterAdd(array $sectionFields): bool
    {
        if (
            $sectionFields['RESULT'] !== false
            && ! $sectionFields['IBLOCK_SECTION_ID']
            && iblock_code($sectionFields['IBLOCK_ID']) === 'collabs'
            && Loader::includeModule('subscribe')
        ) {
            $rubric = new CRubric();
            $rubricFields = [
                "ACTIVE" => $sectionFields['ACTIVE'] === 'Y' ? 'Y' : 'N',
                'VISIBLE' => 'Y',
                "NAME" => 'Коллабы: ' . $sectionFields['NAME'],
                "SORT" => $sectionFields['SORT'],
                'CODE' => 'collabs:' . $sectionFields['CODE'],
                "LID" => Context::getCurrent()->getSite() ?? 's1'
            ];
            if (! $rubric->Add($rubricFields)) {
                app()->throwException('Ошибка создания рассылки: ' . $rubric->LAST_ERROR);
                return false;
            }
        }
        
        static::$oldFields = [];
        return true;
    }
    
    
    public static function onBeforeUpdate(array $sectionFields): void
    {
        if (iblock_code($sectionFields['IBLOCK_ID']) === 'collabs') {
            SectionTable::setIblockId($sectionFields['IBLOCK_ID']);
            static::$oldFields = SectionTable::query()
                ->setFilter(['=ID' => $sectionFields['ID']])
                ->setLimit(1)
                ->setSelect(['ACTIVE', 'NAME', 'SORT', 'CODE', 'IBLOCK_SECTION_ID'])
                ->fetch();
        }
    }
    
    public static function onAfterUpdate(array $sectionFields): bool
    {
        if (
            $sectionFields['RESULT'] !== false
            && count(static::$oldFields) > 0
            && iblock_code($sectionFields['IBLOCK_ID']) === 'collabs'
            && Loader::includeModule('subscribe')
        ) {
            if ($sectionFields['IBLOCK_SECTION_ID'] && ! static::$oldFields['IBLOCK_SECTION_ID']) {
                return static::onAfterDelete($sectionFields);
            }
            
            $result = CRubric::GetList([], ['CODE' => 'collabs:' . static::$oldFields['CODE']]);
            if ($result && $existedRubric = $result->Fetch()) {
                $rubric = new CRubric();
                $rubricFields = [
                    "ACTIVE" => ($sectionFields['ACTIVE'] ?? static::$oldFields['ACTIVE']) === 'Y' ? 'Y' : 'N',
                    "NAME" => 'Коллабы: ' . ($sectionFields['NAME'] ?? static::$oldFields['NAME']),
                    "SORT" => $sectionFields['SORT'] ?? static::$oldFields['SORT'],
                    'CODE' => 'collabs:' . ($sectionFields['CODE'] ?? static::$oldFields['CODE']),
                    "LID" => Context::getCurrent()->getSite() ?? 's1'
                ];
                if (! $rubric->Update($existedRubric['ID'], $rubricFields)) {
                    app()->throwException('Ошибка обновления рассылки: ' . $rubric->LAST_ERROR, $existedRubric['ID']);
                    return false;
                }
            } else {
                return static::onAfterAdd($sectionFields);
            }
        }
        static::$oldFields = [];
        return true;
    }
    
    public static function onAfterDelete(array $sectionFields): bool
    {
        if (
            iblock_code($sectionFields['IBLOCK_ID']) === 'collabs'
            && Loader::includeModule('subscribe')
        ) {
            $result = CRubric::GetList([], ['CODE' => 'collabs:' . ($sectionFields['CODE'] ?? static::$oldFields['CODE'])]);
            if ($result && $existedRubric = $result->Fetch()) {
                CRubric::Delete($existedRubric['ID']);
            }
        }
        static::$oldFields = [];
        return true;
    }
}
