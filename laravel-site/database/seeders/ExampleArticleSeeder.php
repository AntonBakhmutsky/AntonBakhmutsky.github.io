<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Traits\CheckAdminUser;
use Illuminate\Database\Seeder;

class ExampleArticleSeeder extends Seeder
{
  use CheckAdminUser;

  public function run(): void
  {
    $this->checkAdminUser();

    Article::factory()
      ->count(20)
      ->create()
      ->random(10)->each(Article::metaFactoryFunction());
  }
}
