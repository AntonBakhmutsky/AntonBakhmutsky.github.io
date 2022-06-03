<?php


namespace App\Casts;


use Arr;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Query\Expression;

class PhoneArrayCast extends ArrayCast implements CastsAttributes
{
  final public function set($model, string $key, $value, array $attributes): Expression
  {
    $value = $value && is_array($value)
      ? Arr::flatten($value)
      : $value;

    return parent::set($model, $key, $value, $attributes);
  }
}
