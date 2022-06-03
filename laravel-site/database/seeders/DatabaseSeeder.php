<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(
      [
        SettingsSeeder::class,
        ExampleMenuSeeder::class,
        ExampleCatalogSeeder::class,
        ExampleArticleSeeder::class,
        ExamplePromotionSeeder::class,
        ExampleCemeterySeeder::class
      ]
    );
  }
}
