<?php


namespace ITLeague\Components\MetaData;

use Bitrix\Iblock;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;
use CASDiblockTools;
use ITLeague\Interfaces\MetaDataInterface;


class IblockMetaData extends Base implements MetaDataInterface
{
    /**
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\LoaderException
     */
    public static function create(int $iblockId): self
    {
        $iblock = IblockTable::query()
            ->setFilter(['=ID' => $iblockId])
            ->setLimit(1)
            ->setSelect(['ID', 'NAME', 'DESCRIPTION'])
            ->fetch();
        return new static($iblock);
    }
    
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
        $values = new Iblock\InheritedProperty\IblockValues($this->element['ID']);
        $this->values = $values->getValues();
        $this->values['COLOR'] = CASDiblockTools::GetIBUF($this->element['ID'], 'UF_COLOR') ?? '';
    }
}
