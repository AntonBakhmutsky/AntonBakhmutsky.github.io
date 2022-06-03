<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Traits\CheckAdminUser;
use Illuminate\Database\Seeder;

class ExamplePromotionSeeder extends Seeder
{
  use CheckAdminUser;

  public function run(): void
  {
    $this->checkAdminUser();

    Promotion::factory()->count(20)->create()->random(10)->each(Promotion::metaFactoryFunction());
  }
}
