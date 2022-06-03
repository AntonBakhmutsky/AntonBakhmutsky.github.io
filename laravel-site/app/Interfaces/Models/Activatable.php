<?php


namespace App\Interfaces\Models;


use Illuminate\Database\Eloquent\Builder;

interface Activatable
{
  public function scopeActive(Builder $builder, bool $value = true): Builder;
}
