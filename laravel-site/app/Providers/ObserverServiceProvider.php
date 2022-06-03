<?php

namespace App\Providers;

use App\Models\CatalogCategory;
use App\Models\CatalogProduct;
use App\Models\Cemetery;
use App\Models\Page;
use App\Models\Request;
use App\Models\Setting;
use App\Observers\CatalogCategoryObserver;
use App\Observers\CatalogProductObserver;
use App\Observers\CemeteryObserver;
use App\Observers\MenuItemObserver;
use App\Observers\PageObserver;
use App\Observers\RequestObserver;
use App\Observers\SettingObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\MenuItem;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
      MenuItem\TopMenuItem::observe(MenuItemObserver::class);
      MenuItem\BottomMenuItem::observe(MenuItemObserver::class);
      MenuItem\MainMenuItem::observe(MenuItemObserver::class);
      Setting::observe(SettingObserver::class);
      Page::observe(PageObserver::class);
      Request::observe(RequestObserver::class);
      Cemetery::observe(CemeteryObserver::class);
      CatalogCategory::observe(CatalogCategoryObserver::class);
      CatalogProduct::observe(CatalogProductObserver::class);
    }
}
