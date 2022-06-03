<?php

namespace ITLeague\Iblock;


class SectionTable extends \Bitrix\Iblock\SectionTable
{
    private static ?int $iblockId = null;
    private static ?string $iblockCode = null;
    
    public static function getObjectClass(): string
    {
        return Section::class;
    }
    
    public static function getCollectionClass(): string
    {
        return SectionCollection::class;
    }
    
    /**
     * @param \Bitrix\Main\ORM\Query\Query $query
     *
     * @return void
     * @throws \Exception
     */
    public static function setDefaultScope($query): void
    {
        if (is_null(self::$iblockId) && is_null(self::$iblockCode)) {
            throw new \Exception('Iblock code and iblock id variables are empty!');
        }
        
        self::$iblockId
            ? $query->where('IBLOCK_ID', self::$iblockId)
            : $query->where("IBLOCK.CODE", self::$iblockCode);
    }
    
    public static function getUfId(): ?string
    {
        return self::$iblockId ? 'IBLOCK_' . self::$iblockId . '_SECTION' : null;
    }
    
    public static function setIblockId(int $iblockId): void
    {
        self::$iblockId = $iblockId;
    }
    
    public static function setIblockCode(string $iblockCode): void
    {
        self::$iblockCode = $iblockCode;
    }
}
