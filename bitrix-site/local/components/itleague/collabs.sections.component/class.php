<?php

use ITLeague\Components\BaseComponent;
use ITLeague\Components\MetaData\IblockMetaData;
use ITLeague\Components\Traits\HasIblockData;
use ITLeague\Components\Traits\HasSeoData;
use ITLeague\Iblock\SectionTable;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class CollabsSectionsComponent extends BaseComponent
{
    use HasIblockData;
    
    protected array $modules = ['iblock', 'asd.iblock'];
    
    private array $sections;
    
    public function onPrepareComponentParams($arParams): array
    {
        $arParams['COLOR'] = trim($arParams['COLOR']);
        return parent::onPrepareComponentParams($arParams);
    }
    
    public function __construct($component = null)
    {
        parent::__construct($component);
        $this->iblockCode = 'collabs';
        $this->iblockTypeId = 'catalog';
    }
    
    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    private function setSections(): void
    {
        SectionTable::setIblockId($this->iblock->getId());
        $this->sections = SectionTable::query()
            ->setFilter(
                [
                    '=ACTIVE' => 'Y',
                    '=DEPTH_LEVEL' => 1
                ]
            )
            ->setSelect(['ID', 'IBLOCK_ID', 'NAME', 'PICTURE', 'CODE', 'TIMESTAMP_X', 'UF_ARCHIVED'])
            ->setOrder(['SORT' => 'ASC'])
            ->setLimit(100)
            ->fetchAll();
        
        foreach ($this->sections as &$section) {
            $section['SECTION_PAGE_URL'] = CIBlock::ReplaceDetailUrl($this->iblock->getSectionPageUrl(), $section, true, 'S');
            $this->checkLastModified($section);
            $this->setItemProperties($section, 'S');
        }
    }
    
    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\LoaderException
     */
    public function executeComponent(): void
    {
        if (! $this->hasCache()) {
            $this->setIblock();
            $this->setSections();
            
            $this->setTaggedCache($this->iblock->getId());
            
            $this->arResult['SECTIONS'] = $this->sections;
            $this->arResult['IBLOCK'] = $this->iblock->collectValues();
            
            $this->arResult['IPROPERTY_VALUES'] = new IblockMetaData($this->arResult['IBLOCK']);
            $this->getCache()->endDataCache($this->arResult);
        }
        
        $this->includeComponentTemplate();
        $this->arResult['IPROPERTY_VALUES']->set();
        $this->setOpenGraphProperties();
        
        if (strlen($this->arParams['COLOR']) > 0) {
            app()->SetPageProperty('COLOR', "style='--color:{$this->arParams['COLOR']}'");
        }
    }
}
