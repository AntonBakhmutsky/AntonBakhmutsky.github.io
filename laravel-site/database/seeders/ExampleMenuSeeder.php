<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Traits\CheckAdminUser;
use Cache;
use Illuminate\Database\Seeder;

class ExampleMenuSeeder extends Seeder
{
  use CheckAdminUser;

  public function run(): void
  {
    $this->checkAdminUser();

    MenuItem::factory()->count(10)->create();
    MenuItem::factory()->count(30)->child()->create();
    Cache::forget(MenuItem::CACHE_KEY);
  }
}
