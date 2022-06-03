<?php

namespace App\Observers;

use App\Helpers\Map;
use App\Models\Cemetery;
use Arr;

class CemeteryObserver
{
  public function saving(Cemetery $cemetery): void
  {
    if ($cemetery->coordinates && is_array($cemetery->coordinates)) {
      $map = new Map(Arr::flatten($cemetery->coordinates));
      $cemetery->coordinates = [(string)$map->getLat(), (string)$map->getLng()];
    }
  }
}
