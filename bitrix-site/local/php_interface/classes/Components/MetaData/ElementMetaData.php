<?php


namespace ITLeague\Components\MetaData;


use Bitrix\Iblock;
use Bitrix\Main\Loader;
use CASDiblockTools;
use ITLeague\Iblock\SectionTable;
use ITLeague\Interfaces\MetaDataInterface;

class ElementMetaData extends Base implements MetaDataInterface
{
    private array $section;
    
    /**
     * @throws \Bitrix\Main\LoaderException
     */
    public function __construct(array $element)
    {
        Loader::includeModule('asd.iblock');
        $this->element = $element;
        $this->init();
    }
    
    public function init(): void
    {
        $values = new Iblock\InheritedProperty\ElementValues($this->element['IBLOCK_ID'], $this->element['ID']);
        $this->values = $values->getValues();
        if ($this->element['IBLOCK_SECTION_ID']) {
            SectionTable::setIblockId($this->element['IBLOCK_ID']);
            $select = ['ID', 'UF_COLOR', 'IBLOCK_SECTION_ID', 'DEPTH_LEVEL'];
            $this->section = SectionTable::query()
                ->setFilter(['=ID' => $this->element['IBLOCK_SECTION_ID']])
                ->setLimit(1)
                ->setSelect($select)
                ->fetch();
            
            while ($this->section['DEPTH_LEVEL'] > 1) {
                $this->section = SectionTable::query()
                    ->setFilter(['=ID' => $this->section['IBLOCK_SECTION_ID']])
                    ->setLimit(1)
                    ->setSelect($select)
                    ->fetch();
            }
        }
        
        $this->values['COLOR'] = strlen($this->section['UF_COLOR'] ?? '') === 0 ? CASDiblockTools::GetIBUF(
                $this->element['IBLOCK_ID'],
                'UF_COLOR'
            ) ?? '' : $this->section['UF_COLOR'];
    }
    
    /**
     * @return array
     */
    public function getSection(): array
    {
        return $this->section ?? [];
    }
}
