<?php

namespace App\Observers;

use App\Models\Page;
use Cache;

class PageObserver
{
  public function saved(Page $page): void
  {
    $this->forgetCache();
  }

  public function deleted(Page $page): void
  {
    $this->forgetCache();
  }

  private function forgetCache()
  {
    Cache::tags(Page::CACHE_KEY)->flush();
  }
}
