<?php


namespace App\Scopes;


use App\Casts\ArrayCast;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ArrayAttributeScope implements Scope
{

  public function apply(Builder $builder, Model $model): void
  {
    foreach ($model->getCasts() as $attribute => $cast) {
      if ($cast === ArrayCast::class || is_subclass_of($cast, ArrayCast::class)) {
        if (is_null($builder->getQuery()->columns)) {
          $builder->addSelect($model->getTable() . '.*');
        }
        $builder->addSelect(DB::raw("array_to_json(\"{$model->getTable()}\".\"{$attribute}\") as \"$attribute\""));
      }
    }
  }
}
