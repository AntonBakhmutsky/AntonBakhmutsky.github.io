<?php

namespace Database\Seeders;

use App\Models\CatalogCategory;
use App\Models\CatalogProduct;
use App\Traits\CheckAdminUser;
use Illuminate\Database\Seeder;

class ExampleCatalogSeeder extends Seeder
{
  use CheckAdminUser;

  public function run(): void
  {
    $this->checkAdminUser();

    CatalogCategory::factory()->count(5)->create()->random(2)->each(CatalogCategory::metaFactoryFunction());
    CatalogCategory::factory()->count(10)->child()->create()->random(5)->each(CatalogCategory::metaFactoryFunction());
    CatalogCategory::factory()->count(20)->hasProducts(4)->child()->create()->random(10)->each(CatalogCategory::metaFactoryFunction());
    CatalogProduct::all()->random(40)->each(CatalogProduct::metaFactoryFunction());
  }
}
