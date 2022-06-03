<?php

use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Type\DateTime;
use ITLeague\Components\BaseComponent;
use ITLeague\Components\MetaData\IblockMetaData;
use ITLeague\Components\Traits\HasIblockData;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class MerchListComponent extends BaseComponent
{
    use HasIblockData;
    
    protected array $modules = ['iblock', 'asd.iblock'];
    
    private array $items;
    
    public function __construct($component = null)
    {
        parent::__construct($component);
        $this->iblockCode = 'merch';
        $this->iblockTypeId = 'catalog';
    }
    
    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    private function setItems(): void
    {
        $now = new DateTime();
        
        $this->items = ElementTable::query()->setFilter(
            [
                '=ACTIVE' => 'Y',
                '=IBLOCK_ID' => $this->iblock->getId(),
                [
                    'LOGIC' => 'OR',
                    '=ACTIVE_FROM' => false,
                    '>=ACTIVE_FROM' => $now
                ],
                [
                    'LOGIC' => 'OR',
                    '=ACTIVE_TO' => false,
                    '<=ACTIVE_FROM' => $now
                ]
            ]
        )
            ->setSelect(['ID', 'IBLOCK_ID', 'NAME', 'PICTURE' => 'DETAIL_PICTURE', 'TIMESTAMP_X',])
            ->setOrder(['SORT' => 'ASC'])
            ->fetchAll();
        
        foreach ($this->items as &$item) {
            $this->checkLastModified($item);
            $this->setItemProperties($item, 'E');
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
            
            $this->arResult['IPROPERTY_VALUES'] = new IblockMetaData($this->arResult['IBLOCK']);
            $this->getCache()->endDataCache($this->arResult);
        }
        
        $this->includeComponentTemplate();
        $this->arResult['IPROPERTY_VALUES']->set();
        $this->setOpenGraphProperties();
    }
}
