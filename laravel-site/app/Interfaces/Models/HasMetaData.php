<?php


namespace App\Interfaces\Models;


use App\Models\MetaTag;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property MetaTag $meta
 * @property string|null $html
 * @property string $name
 */
interface HasMetaData
{
  public function meta(): HasOne;
}
