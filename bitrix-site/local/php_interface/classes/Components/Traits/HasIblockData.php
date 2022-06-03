<?php


namespace ITLeague\Components\Traits;


use Bitrix\Iblock;
use Bitrix\Iblock\IblockTable;
use CFile;
use Exception;

trait HasIblockData
{
    protected Iblock\Iblock $iblock;
    
    protected string $iblockTypeId;
    protected string $iblockCode;
    
    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     * @throws \Exception
     */
    protected function setIblock(): void
    {
        if (is_null($this->iblockCode)) {
            throw new Exception('Iblock code variable is empty!');
        }
        $this->iblock = IblockTable::query()
            ->setFilter(['=IBLOCK_TYPE_ID' => $this->iblockTypeId ?? 'catalog', '=ACTIVE' => 'Y', '=CODE' => $this->iblockCode])
            ->setLimit(1)
            ->setSelect(['ID', 'LID', 'TIMESTAMP_X', 'NAME', 'PICTURE', 'DESCRIPTION', 'CODE', 'DETAIL_PAGE_URL', 'SECTION_PAGE_URL', 'LIST_PAGE_URL'])
            ->fetchObject();
        
        $this->checkLastModified($this->iblock->collectValues());
    }
    
    protected function setOpenGraphProperties(): void
    {
        if ($this->arResult['IBLOCK']['DESCRIPTION']) {
            app()->SetPageProperty('og:description', $this->arResult['IBLOCK']['DESCRIPTION']);
        }
        if ($this->arResult['IBLOCK']['PICTURE']) {
            app()->SetPageProperty('og:image', CFile::GetPath($this->arResult['IBLOCK']['PICTURE']));
        }
    }
}
