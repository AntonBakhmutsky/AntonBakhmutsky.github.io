<?php


namespace ITLeague\Components\MetaData;

use Bitrix\Main;
use ITLeague\Helpers\Color;
use ITLeague\Interfaces\MetaDataInterface;

abstract class Base implements MetaDataInterface
{
    protected array $values;
    protected array $element;
    
    abstract public function init(): void;
    
    public function get(): array
    {
        return $this->values;
    }
    
    public function set(): void
    {
        $this->setTitle();
        $this->setKeywords();
        $this->setDescription();
        $this->setColor();
    }
    
    protected function setTitle(): void
    {
        $browserTitle = Main\Type\Collection::firstNotEmpty(
            $this->values,
            'SECTION_PAGE_TITLE',
            $this->values,
            'SECTION_META_TITLE',
            $this->element,
            'NAME'
        );
        if (is_array($browserTitle)) {
            app()->SetTitle(implode(' ', $browserTitle));
            app()->SetPageProperty('title', implode(' ', $browserTitle));
        } elseif ($browserTitle !== '') {
            app()->SetTitle($browserTitle);
            app()->SetPageProperty('title', $browserTitle);
        }
    }
    
    protected function setColor(): void
    {
        if ($this->values['COLOR'] !== '') {
            Color::set($this->values['COLOR']);
        }
    }
    
    protected function setKeywords(): void
    {
        $metaKeywords = $this->values['SECTION_META_KEYWORDS'];
        if (is_array($metaKeywords)) {
            app()->SetPageProperty('keywords', implode(' ', $metaKeywords));
        } elseif ($metaKeywords !== '') {
            app()->SetPageProperty('keywords', $metaKeywords);
        }
    }
    
    protected function setDescription(): void
    {
        $metaDescription = Main\Type\Collection::firstNotEmpty(
            $this->values,
            'SECTION_META_DESCRIPTION',
            $this->element,
            'DESCRIPTION'
        );
        if (is_array($metaDescription)) {
            app()->SetPageProperty('description', implode(' ', $metaDescription));
        } elseif ($metaDescription !== '') {
            app()->SetPageProperty('description', $metaDescription);
        }
    }
}
