<?php


namespace App\Traits\Models;


use Illuminate\Database\Eloquent\Builder;

trait WithActiveAttribute
{
  public function initializeWithActiveAttribute(): void
  {
    $this->mergeCasts(['active' => 'boolean']);
  }

  public function scopeActive(Builder $builder, bool $value = true): Builder
  {
    return $builder->whereActive($value);
  }
}
