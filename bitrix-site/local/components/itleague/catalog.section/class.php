<?php

use Bitrix\Currency\CurrencyManager;
use Bitrix\Iblock;
use Bitrix\Main\Error;
use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

CBitrixComponent::includeComponentClass("bitrix:catalog.section");


class ItLeagueCatalogSection extends CatalogSectionComponent
{
    public function onPrepareComponentParams($params): array
    {
        $params = parent::onPrepareComponentParams($params);
        $params['SHOW_DEACTIVATED'] = isset($params['SHOW_DEACTIVATED']) && $params['SHOW_DEACTIVATED'] === 'Y';
        return $params;
    }

    protected function initSectionResult(): bool
    {
        $success = true;
        $selectFields = [];

        if (!empty($this->arParams['SECTION_USER_FIELDS']) && is_array($this->arParams['SECTION_USER_FIELDS'])) {
            foreach ($this->arParams['SECTION_USER_FIELDS'] as $field) {
                if (is_string($field) && preg_match('/^UF_/', $field)) {
                    $selectFields[] = $field;
                }
            }
        }

        if (preg_match('/^UF_/', $this->arParams['META_KEYWORDS'])) {
            $selectFields[] = $this->arParams['META_KEYWORDS'];
        }

        if (preg_match('/^UF_/', $this->arParams['META_DESCRIPTION'])) {
            $selectFields[] = $this->arParams['META_DESCRIPTION'];
        }

        if (preg_match('/^UF_/', $this->arParams['BROWSER_TITLE'])) {
            $selectFields[] = $this->arParams['BROWSER_TITLE'];
        }

        if (preg_match('/^UF_/', $this->arParams['BACKGROUND_IMAGE'])) {
            $selectFields[] = $this->arParams['BACKGROUND_IMAGE'];
        }

        $filterFields = [
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'IBLOCK_ACTIVE' => 'Y'
        ];
        if (!$this->arParams['SHOW_DEACTIVATED']) {
            $filterFields['ACTIVE'] = 'Y';
            $filterFields['GLOBAL_ACTIVE'] = 'Y';
        }

        // Hidden tricky parameter USED to display linked
        // by default it is not set
        if ($this->arParams['BY_LINK'] === 'Y') {
            $sectionResult = [
                'ID' => 0,
                'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            ];
        } elseif ($this->arParams['SECTION_ID'] > 0) {
            $filterFields['ID'] = $this->arParams['SECTION_ID'];
            $sectionIterator = CIBlockSection::GetList([], $filterFields, false, $selectFields);
            $sectionIterator->SetUrlTemplates('', $this->arParams['SECTION_URL']);
            $sectionResult = $sectionIterator->GetNext();
        } elseif ($this->arParams['SECTION_CODE'] <> '') {
            $filterFields['=CODE'] = $this->arParams['SECTION_CODE'];
            $sectionIterator = CIBlockSection::GetList([], $filterFields, false, $selectFields);
            $sectionIterator->SetUrlTemplates('', $this->arParams['SECTION_URL']);
            $sectionResult = $sectionIterator->GetNext();
        } elseif ($this->arParams['SECTION_CODE_PATH'] <> '') {
            $sectionId = CIBlockFindTools::GetSectionIDByCodePath($this->arParams['IBLOCK_ID'], $this->arParams['SECTION_CODE_PATH']);
            if ($sectionId) {
                $filterFields['ID'] = $sectionId;
                $sectionIterator = CIBlockSection::GetList([], $filterFields, false, $selectFields);
                $sectionIterator->SetUrlTemplates('', $this->arParams['SECTION_URL']);
                $sectionResult = $sectionIterator->GetNext();
            }
        } else    // Root section (no section filter)
        {
            $sectionResult = [
                'ID' => 0,
                'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            ];
        }

        if (empty($sectionResult)) {
            $success = false;
            $this->abortResultCache();
            $this->errorCollection->setError(new Error(Loc::getMessage('CATALOG_SECTION_NOT_FOUND'), self::ERROR_404));
        } else {
            $this->arResult = array_merge($this->arResult, $sectionResult);
            if ($this->arResult['ID'] > 0 && $this->arParams['ADD_SECTIONS_CHAIN']) {
                $this->arResult['PATH'] = [];
                $pathIterator = CIBlockSection::GetNavChain(
                    $this->arResult['IBLOCK_ID'],
                    $this->arResult['ID'],
                    [
                        'ID',
                        'CODE',
                        'XML_ID',
                        'EXTERNAL_ID',
                        'IBLOCK_ID',
                        'IBLOCK_SECTION_ID',
                        'SORT',
                        'NAME',
                        'ACTIVE',
                        'DEPTH_LEVEL',
                        'SECTION_PAGE_URL'
                    ]
                );
                $pathIterator->SetUrlTemplates('', $this->arParams['SECTION_URL']);
                while ($path = $pathIterator->GetNext()) {
                    $ipropValues = new Iblock\InheritedProperty\SectionValues($this->arParams['IBLOCK_ID'], $path['ID']);
                    $path['IPROPERTY_VALUES'] = $ipropValues->getValues();
                    $this->arResult['PATH'][] = $path;
                }

                if ($this->arParams['SECTIONS_CHAIN_START_FROM'] > 0) {
                    $this->arResult['PATH'] = array_slice($this->arResult['PATH'], $this->arParams['SECTIONS_CHAIN_START_FROM']);
                }
            }
        }

        return $success;
    }

    protected function editTemplateItems(&$items)
    {
        parent::editTemplateItems($items);

        foreach ($items as &$item) {

            if ($item['CATALOG'] && !empty($item['OFFERS'])) {
                $baseCurrency = '';
                if ($this->arResult['MODULES']['catalog'] && !isset($this->arResult['CONVERT_CURRENCY']['CURRENCY_ID'])) {
                    $baseCurrency = CurrencyManager::getBaseCurrency();
                }

                $currency = $this->arResult['CONVERT_CURRENCY']['CURRENCY_ID'] ?? $baseCurrency;

                $item['ITEM_END_PRICE'] = null;
                $item['ITEM_END_PRICE_SELECTED'] = null;

                $maxPrice = null;
                $maxPriceIndex = null;
                foreach (array_keys($item['OFFERS']) as $index) {
                    if (!$item['OFFERS'][$index]['CAN_BUY'] || $item['OFFERS'][$index]['ITEM_PRICE_SELECTED'] === null) {
                        continue;
                    }

                    $currentPrice = $item['OFFERS'][$index]['ITEM_PRICES'][$item['OFFERS'][$index]['ITEM_PRICE_SELECTED']];
                    if ($currentPrice['CURRENCY'] != $currency) {
                        $priceScale = CCurrencyRates::ConvertCurrency(
                            $currentPrice['RATIO_PRICE'],
                            $currentPrice['CURRENCY'],
                            $currency
                        );
                    } else {
                        $priceScale = $currentPrice['RATIO_PRICE'];
                    }
                    if ($maxPrice === null || $maxPrice < $priceScale) {
                        $maxPrice = $priceScale;
                        $maxPriceIndex = $index;
                    }
                    unset($priceScale, $currentPrice);
                }
                unset($index);

                if ($maxPriceIndex !== null) {
                    $maxOffer = $item['OFFERS'][$maxPriceIndex];
                    $item['ITEM_END_PRICE_SELECTED'] = $maxPriceIndex;
                    $item['ITEM_END_PRICE'] = $maxOffer['ITEM_PRICES'][$maxOffer['ITEM_PRICE_SELECTED']];
                    unset($maxOffer);
                }
                unset($maxPriceIndex, $maxPrice, $baseCurrency, $currency);
            }
        }
    }
}
