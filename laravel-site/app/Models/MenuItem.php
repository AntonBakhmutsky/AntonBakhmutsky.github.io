<?php

namespace App\Models;

use App\Interfaces\Models\Activatable;
use App\Interfaces\Models\Loggable;
use App\Interfaces\Models\Sortable;
use App\Traits\Models\SoftDeletes;
use App\Traits\Models\WithActiveAttribute;
use App\Traits\Models\WithSortAttribute;
use App\Traits\Models\WithUserAttributes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JetBrains\PhpStorm\Pure;

class MenuItem extends Model implements Sortable, Activatable, Loggable
{
  use HasFactory;
  use WithUserAttributes;
  use SoftDeletes;
  use WithActiveAttribute;
  use WithSortAttribute;

  public const TYPE_TOP = 'top';
  public const TYPE_MAIN = 'main';
  public const TYPE_BOTTOM = 'bottom';

  public const CACHE_TTL = 86400;
  public const CACHE_KEY = 'menu_items';

  protected $guarded = ['id'];

  protected $table = 'menu_items';

  public function __construct(array $attributes = [])
  {
    $this->type = $this->getType();
    parent::__construct($attributes);
  }

  public function getType(): ?string
  {
    return null;
  }

  public function parent(): BelongsTo
  {
    return $this->belongsTo(static::class, 'parent_id', 'id');
  }

  public function children(): HasMany
  {
    return $this->hasMany(static::class, 'parent_id', 'id');
  }

  public function scopeRoot(Builder $builder, bool $value = true): Builder
  {
    return $value ? $builder->whereNull('parent_id') : $builder->whereNotNull('parent_id');
  }

  #[Pure]
  public function getLinkAttribute(?string $value): ?string
  {
    return $value ? trim($value, '/') : $value;
  }
}
