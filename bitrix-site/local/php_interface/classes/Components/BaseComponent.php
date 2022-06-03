<?php


namespace ITLeague\Components;


use Bitrix\Main\Application;
use Bitrix\Main\Context;
use Bitrix\Main\Data\Cache;
use Bitrix\Main\Data\TaggedCache;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Type\DateTime;
use CBitrixComponent;
use CMain;
use Bitrix\Iblock;
use Bitrix\Main;
use CUser;

abstract class BaseComponent extends CBitrixComponent
{
    protected array $modules = [];
    private Cache $__cache;
    private TaggedCache $__taggedCache;
    
    public function onPrepareComponentParams($arParams): array
    {
        $arParams['CACHE_TIME'] = $arParams['CACHE_TIME'] > 0 ? intval($arParams['CACHE_TIME']) : 3600;
        return $arParams;
    }
    
    /**
     * @throws \Bitrix\Main\LoaderException
     */
    public function __construct($component = null)
    {
        parent::__construct($component);
        
        $this->checkModules();
        $this->__cache = Cache::createInstance();
        $this->__taggedCache = Application::getInstance()->getTaggedCache();
    }
    
    public function _user(): CUser
    {
        global $USER;
        return $USER;
    }
    
    public function getUserId(): ?int
    {
        return $this->_user()->IsAuthorized() ? (int)$this->_user()->GetID() : null;
    }
    
    /**
     * @throws \Bitrix\Main\LoaderException
     */
    private function checkModules(): void
    {
        foreach ($this->modules as $module) {
            if (! Loader::includeModule($module)) {
                throw new LoaderException("Ошибка загрузки модуля '$module'");
            }
        }
    }
    
    public function getCache(): Cache
    {
        return $this->__cache;
    }
    
    public function getTaggedCache(): TaggedCache
    {
        return $this->__taggedCache;
    }
    
    public function getCacheDir(): string
    {
        return '/itleague/components/' . md5($this->request->getRequestedPageDirectory() . $this->getName());
    }
    
    protected function setTaggedCache(int $iblockId): void
    {
        $this->getTaggedCache()->startTagCache($this->getCacheDir());
        $this->getTaggedCache()->registerTag("iblock_id_" . $iblockId);
        $this->getTaggedCache()->registerTag("iblock_id_new");
        $this->getTaggedCache()->endTagCache();
    }
    
    protected function hasCache(): bool
    {
        if ($this->getCache()->initCache($this->arParams["CACHE_TIME"], $this->getCacheID(), $this->getCacheDir())) {
            $this->arResult = $this->getCache()->getVars();
            return true;
        }
        $this->getCache()->startDataCache();
        
        return false;
    }
    
    protected function checkLastModified(array $item): void
    {
        $time = DateTime::createFromUserTime($item['TIMESTAMP_X']);
        Context::getCurrent()->getResponse()->setLastModified($time);
    }
    
    public function setItemProperties(array &$item, string $type): void
    {
        switch ($type) {
            case 'E':
                $class = Iblock\InheritedProperty\ElementValues::class;
                break;
            case 'S':
                $class = Iblock\InheritedProperty\SectionValues::class;
                break;
            default:
                throw new Main\ArgumentException('Invalid item type!');
        }
        $values = new $class($item['IBLOCK_ID'], $item['ID']);
        $item['IPROPERTY_VALUES'] = $values->getValues();
    }
}
