<?php

namespace App\Http\Middleware;

use App\Models\CatalogCategory;
use App\Models\MenuItem;
use Cache;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Lavary\Menu\Builder;
use Menu;

class GenerateMenu
{
  public function handle(Request $request, Closure $next): mixed
  {
    $attributes = [
      'id',
      'name',
      'link',
      'parent_id',
      'type'
    ];

    $menuItems = Cache::remember(
      MenuItem::CACHE_KEY,
      MenuItem::CACHE_TTL,
      fn() => MenuItem::active()
        ->root()
        ->with(['children' => fn(HasMany $builder) => $builder->select($attributes)->active()->sorted()])
        ->sorted()
        ->get($attributes)
    );

    $this->fillMenu($menuItems->where('type', MenuItem::TYPE_TOP), MenuItem::TYPE_TOP);
    $this->fillMenu($menuItems->where('type', MenuItem::TYPE_MAIN), MenuItem::TYPE_MAIN);
    $this->fillMenu($menuItems->where('type', MenuItem::TYPE_BOTTOM), MenuItem::TYPE_BOTTOM);


    return $next($request);
  }

  private function fillMenu(Collection $collection, string $type): void
  {
    Menu::make(
      $type . 'Menu',
      function (Builder $menu) use ($collection): void {
        /** @var MenuItem $item */
        foreach ($collection as $item) {
          $parentItem = $menu->add($item->name, $item->link);
          foreach ($item->children as $childItem) {
            $parentItem->add($childItem->name, $childItem->link);
          }
        }
      }
    );
  }
}
