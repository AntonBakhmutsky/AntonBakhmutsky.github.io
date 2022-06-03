<?php

namespace App\Providers;

use App;
use App\Helpers\Catalog;
use App\Helpers\Settings;
use App\Mixins\BlueprintMixin;
use App\Mixins\PostgresGrammarMixin;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\PostgresGrammar;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   * @throws \ReflectionException
   */
  public function register(): void
  {
    PostgresGrammar::mixin(new PostgresGrammarMixin());
    Blueprint::mixin(new BlueprintMixin());
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    if (App::environment('production')) {
      URL::forceScheme('https');
      $this->app['request']->server->set('HTTPS', 'on');
    }

    Paginator::defaultView('components.global.paginator');
    Paginator::defaultSimpleView('components.global.simple-paginator');

    $this->app->singleton('settings', fn() => new Settings());
    $this->app->singleton('catalog', fn() => new Catalog());
  }
}
