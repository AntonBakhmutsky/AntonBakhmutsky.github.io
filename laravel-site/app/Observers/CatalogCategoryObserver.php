<?php

namespace App\Observers;

use App\Models\CatalogCategory;
use App\Models\CatalogProduct;
use Cache;

class CatalogCategoryObserver
{

  public function saved(CatalogCategory $category): void
  {
    $this->forgetCache();
  }

  public function deleted(CatalogCategory $category): void
  {
    $this->forgetCache();
  }

  private function forgetCache(): void
  {
    /* кэш сбрасывается вообще для всех продуктов */
    Cache::tags(CatalogProduct::CACHE_KEY)->flush();
  }
}
