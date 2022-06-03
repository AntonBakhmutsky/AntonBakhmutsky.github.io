<?php

use App\Helpers;
use App\Models\CatalogCategory;
use Illuminate\Database\Migrations\Migration;

class AddTypeToCatalogCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Helpers\DB::createEnumColumn(
      'catalog_categories',
      'type',
      [CatalogCategory::TYPE_TABBED, CatalogCategory::TYPE_VERTICAL, CatalogCategory::TYPE_HORIZONTAL],
      CatalogCategory::TYPE_HORIZONTAL
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Helpers\DB::dropEnumColumn('catalog_categories', 'type');
  }
}
