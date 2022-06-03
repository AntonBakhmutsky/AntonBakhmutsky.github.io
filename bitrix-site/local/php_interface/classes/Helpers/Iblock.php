<?php


namespace ITLeague\Helpers;


use Bitrix\Iblock\IblockTable;
use Bitrix\Main\ObjectNotFoundException;

class Iblock
{
    public static function getId(string $iblockCode): int
    {
            $iblock = IblockTable::query()
                ->setFilter(['=CODE' => $iblockCode, '=ACTIVE' => 'Y'])
                ->setLimit(1)
                ->setSelect(['ID'])
                ->setCacheTtl(86400)
                ->fetch();
            if ($iblock) {
                return (int)$iblock['ID'];
            }
            
            throw new ObjectNotFoundException("Iblock '$iblockCode' not found!");
    }
}
