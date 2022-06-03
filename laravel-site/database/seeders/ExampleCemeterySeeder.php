<?php

namespace Database\Seeders;

use App\Models\Cemetery;
use App\Traits\CheckAdminUser;
use Illuminate\Database\Seeder;

class ExampleCemeterySeeder extends Seeder
{
  use CheckAdminUser;

  public function run(): void
  {
    $this->checkAdminUser();

    Cemetery::factory()->count(20)->create()->random(10)->each(Cemetery::metaFactoryFunction());
  }
}
