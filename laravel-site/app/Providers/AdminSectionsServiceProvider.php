<?php

namespace App\Providers;

use AdminFormElement;
use AdminNavigation;
use App\Http\Admin\Controllers\CacheController;
use App\Http\Admin\Controllers\SitemapController;
use App\Http\Admin\FormElements\CategoryMultiselect;
use App\Http\Admin\FormElements\TextArray;
use App\Http\Admin\Widgets\NavigationUserBlock;
use App\Models\Article;
use App\Models\CatalogCategory;
use App\Models\CatalogProduct;
use App\Models\Cemetery;
use App\Models\HomepageService;
use App\Models\MenuItem\BottomMenuItem;
use App\Models\MenuItem\MainMenuItem;
use App\Models\MenuItem\TopMenuItem;
use App\Models\MetaTag;
use App\Models\Page;
use App\Models\Promotion;
use App\Models\Request;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Routing\Router;
use PackageManager;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{
  /**
   * @var array
   */
  protected array $widgets = [
    NavigationUserBlock::class,
  ];

  /**
   * @var array
   */
  protected $sections = [
    User::class => 'App\Http\Admin\User',
    Setting::class => 'App\Http\Admin\Setting',
    Request::class => 'App\Http\Admin\Request',
    Page::class => 'App\Http\Admin\Page',
    TopMenuItem::class => 'App\Http\Admin\MenuItem\TopMenuItem',
    MainMenuItem::class => 'App\Http\Admin\MenuItem\MainMenuItem',
    BottomMenuItem::class => 'App\Http\Admin\MenuItem\BottomMenuItem',
    CatalogProduct::class => 'App\Http\Admin\CatalogProduct',
    CatalogCategory::class => 'App\Http\Admin\CatalogCategory',
    MetaTag::class => 'App\Http\Admin\MetaTag',
    Article::class => 'App\Http\Admin\Article',
    Promotion::class => 'App\Http\Admin\Promotion',
    Cemetery::class => 'App\Http\Admin\Cemetery'
  ];

  public function boot(Admin $admin): void
  {
    $this->app->call([$this, 'registerRoutes']);
    $this->app->call([$this, 'registerNavigation']);

    parent::boot($admin);

    AdminFormElement::bind('category_multiselect', CategoryMultiselect::class);
    AdminFormElement::bind('TextArray', TextArray::class);

    $this->app->call([$this, 'registerViews']);
  }

  public function registerViews(WidgetsRegistryInterface $widgetsRegistry)
  {
    foreach ($this->widgets as $widget) {
      $widgetsRegistry->registerWidget($widget);
    }
  }

  public function registerNavigation()
  {
    AdminNavigation::setFromArray(
      [
        [
          'title' => 'Меню',
          'icon' => 'fa fa-group fa-bars',
          'id' => 'menu',
          'priority' => 10
        ],
        [
          'title' => 'Каталог',
          'icon' => 'fa fa-group far fa-folder',
          'id' => 'catalog',
          'priority' => 20
        ],
        [
          'title' => 'Система',
          'icon' => 'fa fa-group fas fa-cogs',
          'id' => 'system',
          'priority' => 60,
          'pages' => [
            [
              'title' => 'Карта сайта',
              'id' => 'sitemap',
              'url' => config('sleeping_owl.url_prefix') . '/sitemap',
              'priority' => 100,
              'icon' => 'fab fa-mendeley'
            ],
            [
              'title' => 'Кэширование',
              'id' => 'cache',
              'url' => config('sleeping_owl.url_prefix') . '/cache',
              'priority' => 110,
              'icon' => 'fas fa-save'
            ]
          ]
        ],
        [
          'title' => 'Контент',
          'icon' => 'fa fa-group fas fa-atlas',
          'id' => 'content',
          'priority' => 40
        ],
        [
          'title' => 'Обратная связь',
          'icon' => 'fa fa-group far fa-comment',
          'id' => 'feedback',
          'priority' => 50
        ]
      ]
    );
  }

  public function registerRoutes()
  {
    $this->app['router']->group(
      ['prefix' => config('sleeping_owl.url_prefix'), 'middleware' => config('sleeping_owl.middleware')],
      function (Router $router) {
        $router->get('sitemap', [SitemapController::class, 'index'])->name('sitemap.index');
        $router->post('sitemap', [SitemapController::class, 'refresh'])->name('sitemap.refresh');


        $router->get('cache', [CacheController::class, 'index'])->name('cache.index');
        $router->post('cache', [CacheController::class, 'clear'])->name('cache.clear');
      }
    );
  }
}
