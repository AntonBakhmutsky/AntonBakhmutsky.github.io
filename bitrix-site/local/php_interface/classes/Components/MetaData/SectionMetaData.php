<?php


namespace ITLeague\Components\MetaData;

use Bitrix\Iblock;
use Bitrix\Main\Loader;
use CASDiblockTools;
use ITLeague\Interfaces\MetaDataInterface;


class SectionMetaData extends Base implements MetaDataInterface
{
    /**
     * @throws \Bitrix\Main\LoaderException
     */
    public function __construct(array $iblock)
    {
        Loader::includeModule('asd.iblock');
        $this->element = $iblock;
        $this->init();
    }
    
    public function init(): void
    {
        $values = new Iblock\InheritedProperty\SectionValues($this->element['IBLOCK_ID'], $this->element['ID']);
        $this->values = $values->getValues();
        $this->values['COLOR'] = strlen($this->element['UF_COLOR']) === 0 ? CASDiblockTools::GetIBUF(
                $this->element['IBLOCK_ID'],
                'UF_COLOR'
            ) ?? '' : $this->element['UF_COLOR'];
    }
}
