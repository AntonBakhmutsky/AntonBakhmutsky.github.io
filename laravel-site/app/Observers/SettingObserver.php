<?php

namespace App\Observers;

use App\Models\Setting;
use Cache;

class SettingObserver
{
  public function saved(Setting $item): void
  {
    Cache::forget(Setting::CACHE_KEY);
  }
}
