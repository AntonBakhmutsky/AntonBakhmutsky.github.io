<?php


namespace App\Helpers;


use App\Models\Setting;
use Cache;
use Illuminate\Database\Eloquent\Collection;

class Settings
{
  private Collection $items;

  public function __construct()
  {
    $this->items = Cache::remember(
      Setting::CACHE_KEY,
      Setting::CACHE_TTL,
      fn() => Setting::all(['code', 'value', 'type'])
    );
  }

  public function get(string $code): bool|string
  {
    /** @var Setting $item */
    $item = $this->items->firstWhere('code', $code);
    return $item?->type === Setting::TYPE_BOOL ? (bool)$item?->value : trim($item?->value);
  }
}
