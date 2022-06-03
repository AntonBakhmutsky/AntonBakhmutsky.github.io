<?php


namespace App\Interfaces\Models;


use Illuminate\Database\Eloquent\Builder;

interface Sortable
{
  public function scopeSorted(Builder $builder): Builder;
}
