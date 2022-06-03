<?php

namespace App\Models;

use App\Casts\ArrayCast;
use App\Interfaces\Models\Activatable;
use App\Interfaces\Models\HasMetaData;
use App\Interfaces\Models\HasMoreImagesAttribute;
use App\Interfaces\Models\HasPublicPage;
use App\Interfaces\Models\Loggable;
use App\Interfaces\Models\Sortable;
use App\Scopes\ArrayAttributeScope;
use App\Traits\Models\SoftDeletes;
use App\Traits\Models\WithActiveAttribute;
use App\Traits\Models\WithMeta;
use App\Traits\Models\WithMoreThumbnails;
use App\Traits\Models\WithSortAttribute;
use App\Traits\Models\WithThumbnail;
use App\Traits\Models\WithUserAttributes;
use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CatalogProduct extends Model implements Sortable, Activatable, Loggable, HasMoreImagesAttribute, HasPublicPage, HasMetaData
{
  use HasFactory;
  use WithMeta;
  use WithUserAttributes;
  use WithActiveAttribute;
  use WithSortAttribute;
  use SoftDeletes;
  use WithThumbnail;
  use WithMoreThumbnails;

  public const CACHE_TTL = 86400;
  public const CACHE_KEY = 'products';

  protected $keyType = 'string';

  protected $guarded = ['id'];

  protected $casts = [
    'show_on_home' => 'boolean',
    'more_images' => ArrayCast::class,
    'price' => 'float'
  ];

  private array $links = [];

  protected static function booted(): void
  {
    static::addGlobalScope(new ArrayAttributeScope());
  }

  public function categories(): BelongsToMany
  {
    return $this->belongsToMany(CatalogCategory::class, 'catalog_product_to_category', 'product_id', 'category_id', 'id', 'id');
  }

  public function getLinkAttribute(): ?string
  {
    return $this->link();
  }

  public function link(?CatalogCategory $category = null): ?string
  {
    $categoryKey = ! is_null($category) ? $category->getKey() : -1;

    /* получаем закешированную ссылку для продукта и текущего раздела */
    return $this->code ? Cache::tags([static::CACHE_KEY, $this->getKey()])->remember(
      "link:{$this->getKey()}:$categoryKey",
      static::CACHE_TTL,
      function () use ($category): ?string {
        if (is_null($category)) {
          $category = $this->firstCategory();
        } elseif ($category->isTabHost()) {
          /* ссылка запрашивается из родительского раздела табов, ищем нужный в дочерних разделах $category */
          if (CatalogProduct::active()->whereCategoryId($category->getKey())->whereKey($this->getKey())->doesntExist()) {
            $category = $this->categories()->active()->whereParentId($category->getKey())->firstOr(['code'], fn() => null);
          }
        }

        return ! is_null($category) ? route('catalog.product', [$category->code, $this->code]) : null;
      }
    ) : null;
  }

  public function firstCategory(): ?CatalogCategory
  {
    if (! $this->relationLoaded('categories')) {
      $this->load(['categories' => fn(BelongsToMany $builder) => $builder->active()->sorted()]);
    }
    return $this->categories->first();
  }

  public function scopeWhereCategoryId(Builder $builder, array|string $categoryId): Builder
  {
    $relation = $this->categories();
    return $builder->join($relation->getTable(), $relation->getForeignPivotKeyName(), $this->getKeyName())
      ->whereIn($relation->getRelatedPivotKeyName(), (array)$categoryId);
  }
}
