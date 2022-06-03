<?php


namespace App\Helpers;


use App\Models\CatalogCategory;

class Catalog
{
  public function homepage(): string
  {
    static $firstCategoryCode;

    if (is_null($firstCategoryCode)) {
      $firstCategoryCode = CatalogCategory::active()->sorted()->root()->limit(1)->pluck('code')->first();
    }
    return $firstCategoryCode ? route('catalog.category', $firstCategoryCode) : route('index');
  }
}
