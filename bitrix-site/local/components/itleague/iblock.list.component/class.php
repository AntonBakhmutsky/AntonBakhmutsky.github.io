<?php

use Bitrix\Iblock\IblockTable;
use ITLeague\Components\BaseComponent;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class HomepageComponent extends BaseComponent
{
    
    protected array $modules = ['iblock'];
    
    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function executeComponent(): void
    {
        if (! $this->hasCache()) {
            $iblocks = IblockTable::query()
                ->setFilter(['=IBLOCK_TYPE_ID' => 'catalog', '=ACTIVE' => 'Y'])
                ->setOrder(['SORT' => 'ASC'])
                ->setLimit(3)
                ->setSelect(['ID', 'LID', 'NAME', 'LIST_PAGE_URL', 'TIMESTAMP_X', 'CODE'])
                ->fetchAll();
            
            foreach ($iblocks as &$iblock) {
                $this->setTaggedCache($iblock['ID']);
                $iblock['LIST_PAGE_URL'] = CIBlock::ReplaceDetailUrl($iblock['LIST_PAGE_URL'], $iblock, true);
                $this->checkLastModified($iblock);
            }
            
            $this->arResult['ITEMS'] = $iblocks;
            
            $this->getCache()->endDataCache($this->arResult);
        }
        
        $this->includeComponentTemplate();
    }
}
