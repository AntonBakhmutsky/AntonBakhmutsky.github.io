<?php


namespace App\Traits\Models;


use Illuminate\Database\Eloquent\Builder;

trait WithSortAttribute
{
  private string $orderField = 'sort';

  public function initializeWithSortAttribute(): void
  {
    $this->mergeCasts([$this->orderField => 'integer']);
  }

  public function scopeSorted(Builder $builder): Builder
  {
    return $builder->orderBy($this->orderField);
  }
}
