<?php


namespace App\Traits\Models;


use Str;

trait CreateCodeFromName
{
  public static function bootCreateCodeFromName(): void
  {
    static::creating(
      function (self $model) {
        $model->code = $model->code ?? Str::slug($model->name);
      }
    );
  }
}
