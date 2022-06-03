<?php

use Bitrix\Iblock\Elements\ElementFaqTable;
use ITLeague\Components\BaseComponent;
use ITLeague\Components\Traits\HasIblockData;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class FaqComponent extends BaseComponent
{
    use HasIblockData;
    
    protected array $modules = ['iblock'];
    
    private array $items;
    
    public function onPrepareComponentParams($arParams): array
    {
        $arParams = parent::onPrepareComponentParams($arParams);
        $arParams['SECTION'] = trim($arParams['SECTION']);
        $arParams['SPOT'] = trim($arParams['SPOT']);
        return $arParams;
    }
    
    public function __construct($component = null)
    {
        parent::__construct($component);
        $this->iblockTypeId = 'content';
        $this->iblockCode = 'faq';
    }
    
    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    private function setItems(): void
    {
        $filter = [
            '=ACTIVE' => 'Y',
            '=IBLOCK_ID' => $this->iblock->getId()
        ];
        if (strlen($this->arParams['SECTION']) > 0) {
            $filter['=SECTION.ITEM.XML_ID'] = $this->arParams['SECTION'];
        }
        $this->items = ElementFaqTable::query()
            ->setFilter($filter)
            ->setSelect(['ID', 'QUESTION' => 'PREVIEW_TEXT', 'ANSWER' => 'DETAIL_TEXT', 'TIMESTAMP_X'])
            ->setOrder(['SORT' => 'ASC'])
            ->fetchAll();
        
        foreach ($this->items as $item) {
            $this->checkLastModified($item);
        }
    }
    
    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function executeComponent(): void
    {
        if (! $this->hasCache()) {
            $this->setIblock();
            $this->setItems();
            
            $this->setTaggedCache($this->iblock->getId());
            
            $this->arResult['ITEMS'] = $this->items;
            $this->arResult['IBLOCK'] = $this->iblock->collectValues();
            
            $this->getCache()->endDataCache($this->arResult);
        }
        
        $this->includeComponentTemplate();
        $this->addMenuItem();
    }
    
    private function addMenuItem()
    {
        if (count($this->arResult['ITEMS']) > 0) {
            $GLOBALS['BX_MENU_CUSTOM']->arItems['top'][] =
                [
                    'TEXT' => "FAQ",
                    'LINK' => "#faq",
                    'PARAMS' => ["class" => "faq"],
                    'SELECTED' => false,
                    "ITEM_INDEX" => 2.5
                ];
        }
    }
}
