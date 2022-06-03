<?php

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Iblock\Elements\ElementSizesTable;
use ITLeague\Components\BaseComponent;
use ITLeague\Components\Traits\HasIblockData;

if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class SizesComponent extends BaseComponent
{
    use HasIblockData;
    
    protected array $modules = ['iblock', 'highloadblock'];
    
    private array $items;
    
    public function onPrepareComponentParams($arParams): array
    {
        $arParams = parent::onPrepareComponentParams($arParams);
        $arParams['CODE'] = trim($arParams['CODE']);
        return $arParams;
    }
    
    public function __construct($component = null)
    {
        parent::__construct($component);
        $this->iblockTypeId = 'content';
        $this->iblockCode = 'sizes';
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
        $collection = ElementSizesTable::query()
            ->setFilter($filter)
            ->setSelect(['ID', 'IBLOCK_ID', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'TIMESTAMP_X', 'TABLE', 'CODE', 'NAME'])
            ->setOrder(['SORT' => 'ASC'])
            ->fetchCollection();
        foreach ($collection as $collectionItem) {
            $item = $collectionItem->collectValues();
            $item['TABLE'] = [];
            foreach ($collectionItem->getTable()->getAll() as $tableLine) {
                $item['TABLE'][] = $tableLine->collectValues();
            }
            $item['ACTIVE'] = $item['CODE'] === $this->arParams['CODE'];
            $this->items[] = $item;
        }
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
            
            $this->getCache()->endDataCache($this->arResult);
        }
        
        $this->includeComponentTemplate();
    }
    
    public static function getTableHtml(array $columns): string
    {
        $table = '<div class="sizes__table" style="grid-template-columns: repeat(' . (count($columns) + 1) . ',1fr)"><div class="sizes__table-item">Рост</div>';
        foreach ($columns as $column) {
            $table .= '<div class="sizes__table-item"><span>' . (static::getColumnData($column['VALUE'])['UF_HEIGHT'] ?? '') . '</span></div>';
        }
        $table .= '<div class="sizes__table-item">Размер</div>';
        foreach ($columns as $column) {
            if ($fileId = static::getColumnData($column['VALUE'])['UF_SIZES_FILE'] ?? false) {
                $data = '<img src="' . CFile::GetPath($fileId) . '" alt="' . $column['VALUE'] . '">';
            } else {
                $data = '<span>' . (static::getColumnData($column['VALUE'])['UF_SIZES_STRING'] ?? '') . '</span>';
            }
            $table .= '<div class="sizes__table-item">' . $data . '</div>';
        }
        $table .= '</div>';
        return $table;
    }
    
    private static function getColumnData(string $xmlId): array
    {
        static $data;
        
        if (! isset($data)) {
            $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => 'SizeTables']]);
            
            $entity = HighloadBlockTable::compileEntity($hlBlock);
            $entityDataClass = $entity->getDataClass();
            $sizes = $entityDataClass::getList();
            while ($size = $sizes->fetch()) {
                $data[$size['UF_XML_ID']] = $size;
            }
        }
        
        return $data[$xmlId] ?? [];
    }
}
