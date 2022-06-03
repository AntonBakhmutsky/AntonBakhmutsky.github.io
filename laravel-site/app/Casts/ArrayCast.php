<?php


namespace App\Casts;


use DB;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Query\Expression;

class ArrayCast implements CastsAttributes
{

  /**
   * @param \Illuminate\Database\Eloquent\Model $model
   * @param string $key
   * @param mixed $value
   * @param array $attributes
   *
   * @return array
   * @throws \Exception
   */
  public function get($model, string $key, $value, array $attributes): array
  {
    $value = $value ? json_decode($value, true) : [];
    return is_array($value) ? array_filter($value) : [];
  }

  /**
   * @param \Illuminate\Database\Eloquent\Model $model
   * @param string $key
   * @param mixed $value
   * @param array $attributes
   *
   * @return \Illuminate\Database\Query\Expression
   */
  public function set($model, string $key, $value, array $attributes): Expression
  {
    $json = json_encode($value);
    return DB::raw("json_to_array('{$json}')::varchar[]");
  }
}
