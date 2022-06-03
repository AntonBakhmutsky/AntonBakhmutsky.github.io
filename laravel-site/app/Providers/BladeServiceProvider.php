<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
  public function boot(): void
  {
    Blade::if(
      'IsHomepage',
      fn() => request()->routeIs('index')
    );

    Blade::directive(
      'date',
      function (string $date): string {
        return "<?= ($date)?->translatedFormat('j F Y') ?>";
      }
    );
  }
}
