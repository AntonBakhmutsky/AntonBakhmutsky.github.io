<?php


namespace App\Traits\Models;


use App\Models\MetaTag;
use Closure;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait WithMeta
{

  public function meta(): HasOne
  {
    return $this->hasOne(MetaTag::class, 'item_id', 'id');
  }

  public static function metaFactoryFunction(): Closure
  {
    return fn(self $model) => $model->meta()->save(MetaTag::factory()->make());
  }
}
