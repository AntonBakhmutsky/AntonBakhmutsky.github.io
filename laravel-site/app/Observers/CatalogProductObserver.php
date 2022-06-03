<?php

namespace App\Observers;

use App\Models\CatalogProduct;
use Cache;

class CatalogProductObserver
{
  public function saved(CatalogProduct $product): void
  {
    /* кэш сбрасывается только для конкретного продукта */
    Cache::tags($product->getKey())->flush();
  }
}
