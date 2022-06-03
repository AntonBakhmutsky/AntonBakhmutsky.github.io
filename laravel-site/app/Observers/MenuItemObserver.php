<?php

namespace App\Observers;

use App\Models\MenuItem;
use Cache;

class MenuItemObserver
{
  public function saved(MenuItem $item): void
  {
    $this->forgetCache();
  }

  public function deleted(MenuItem $item): void
  {
    $this->forgetCache();
  }

  private function forgetCache(): void
  {
    Cache::forget(MenuItem::CACHE_KEY);
  }
}
