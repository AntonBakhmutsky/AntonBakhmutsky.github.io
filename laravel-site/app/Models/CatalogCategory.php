<?php

namespace App\Models;

use App\Interfaces\Models\Activatable;
use App\Interfaces\Models\HasImageAttribute;
use App\Interfaces\Models\HasMetaData;
use App\Interfaces\Models\HasPublicPage;
use App\Interfaces\Models\Loggable;
use App\Interfaces\Models\Sortable;
use App\Traits\Models\CreateCodeFromName;
use App\Traits\Models\SoftDeletes;
use App\Traits\Models\WithActiveAttribute;
use App\Traits\Models\WithHtmlAttribute;
use App\Traits\Models\WithMeta;
use App\Traits\Models\WithSortAttribute;
use App\Traits\Models\WithThumbnail;
use App\Traits\Models\WithUserAttributes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Menu;

class CatalogCategory extends Model implements Sortable, Activatable, Loggable, HasImageAttribute, HasPublicPage, HasMetaData
{
  use HasFactory;
  use WithMeta;
  use WithUserAttributes;
  use WithActiveAttribute;
  use WithSortAttribute;
  use SoftDeletes;
  use WithThumbnail;
  use WithHtmlAttribute;
  use CreateCodeFromName;

  private ?\Illuminate\Support\Collection $tabs;

  public const TEXT_TOP_POSITION = 'top';
  public const TEXT_BOTTOM_POSITION = 'bottom';

  public const TYPE_TABBED = 'tabbed';
  public const TYPE_VERTICAL = 'vertical';
  public const TYPE_HORIZONTAL = 'horizontal';

  protected $keyType = 'string';

  protected $guarded = ['id'];

  protected $casts = [
    'show_on_home' => 'boolean',
    'page_size' => 'integer'
  ];

  public function parent(): BelongsTo
  {
    return $this->belongsTo(static::class);
  }

  public function loadParentRelation(): void
  {
    if (! $this->relationLoaded('parent')) {
      $this->load(['parent' => fn(BelongsTo $builder) => $builder->active()]);
    }
  }

  public function children(): HasMany
  {
    return $this->hasMany(static::class, 'parent_id', 'id');
  }

  public function products(): BelongsToMany
  {
    return $this->belongsToMany(CatalogProduct::class, 'catalog_product_to_category', 'category_id', 'product_id', 'id', 'id');
  }

  public function scopeRoot(Builder $builder, bool $value = true): Builder
  {
    return $value ? $builder->whereNull('parent_id') : $builder->whereNotNull('parent_id');
  }

  public function getLinkAttribute(): string
  {
    return route('catalog.category', $this->code);
  }

  public function getRelativeLinkAttribute(): string
  {
    return route('catalog.category', $this->code, false);
  }

  public static function getCategoryTree(Collection $categories, int $depth = 0): \Illuminate\Support\Collection
  {
    $options = collect();
    /** @var \App\Models\CatalogCategory[] $categories */
    foreach ($categories as $category) {
      $category->name = Str::padLeft('', $depth * 3, '-- ') . $category->name;
      $options->add($category);
      if (count($category->children) > 0) {
        $options = $options->concat(static::getCategoryTree($category->children, $depth + 1));
      }
    }
    return $options;
  }

  public function getTabsAttribute(): \Illuminate\Support\Collection
  {
    if (! isset($this->tabs)) {
      $this->tabs = new \Lavary\Menu\Collection();

      /* такие условия установлены, чтобы нормально отображались разделы,
      когда контент-менеджер по простоте душевной поставил tabbed и родительским,
      и дочерним разделам */
      if ($this->isTabHost()) {
        $this->tabs = Menu::make(
          $this->getKey() . '-tabs',
          function (\Lavary\Menu\Builder $menu): void {
            $menu->add('Все', $this->link);
            foreach ($this->children as $child) {
              $menu->add($child->name, $child->link);
            }
          }
        )->roots();

        /* чистим дочерние разделы, которые уже добавлены в табы */
        $this->replaceChildren();
      } elseif ($this->parentCategoryIsTabbed()) {
        $this->tabs = Menu::make(
          $this->getKey() . '-tabs',
          function (\Lavary\Menu\Builder $menu): void {
            $menu->add('Все', $this->parent->link);
            $this->parent->load(['children' => fn(HasMany $builder) => $builder->active()->sorted()]);
            foreach ($this->parent->children as $child) {
              $menu->add($child->name, $child->link);
            }
          }
        )->roots();
      }
    }

    return $this->tabs;
  }

  public function parentCategoryIsTabbed(): bool
  {
    $isTabbed = false;
    if ($this->parent_id) {
      $this->loadParentRelation();
      $isTabbed = $this->parent?->type === $this::TYPE_TABBED;
    }

    return $isTabbed;
  }

  public function isTabHost(): bool
  {
    return $this->type === $this::TYPE_TABBED && ! $this->parentCategoryIsTabbed();
  }

  public function isTabbed(): bool
  {
    return $this->type === $this::TYPE_TABBED || $this->parentCategoryIsTabbed();
  }

  public function isVertical(): bool
  {
    return $this->type === $this::TYPE_VERTICAL;
  }

  public function isHorizontal(): bool
  {
    return $this->type === $this::TYPE_HORIZONTAL;
  }

  /**
   * Загружает в products постраничный список нужных продуктов
   */
  public function loadProductsByPage(): void
  {
    if ($this->isTabHost()) {
      /* для раздела tabbed подгружаются все продукты подразделов */
      $categoryIds = $this->children->pluck($this->getKeyName())->push($this->getKey())->toArray();
      $products = CatalogProduct::active()->sorted()->whereCategoryId($categoryIds)->groupBy('id')->simplePaginate($this->page_size);
      $this->setRelation('products', $products);
    } else {
      $this->setRelation('products', $this->products()->active()->sorted()->simplePaginate($this->page_size));
    }
  }

  /**
   * Подменяет дочерние разделы их подразделами.
   * Используется для того, чтобы дочерние разделы показывались в табах,
   * а в списке были подразделы дочерних разделов
   * (короче, работает - и не трожь!)
   */
  public function replaceChildren(): void
  {
    $children = new Collection();
    foreach ($this->children as $child) {
      $children = $children->concat($child->children);
    }
    $this->setRelation('children', $children->sortBy('sort'));
  }
}
