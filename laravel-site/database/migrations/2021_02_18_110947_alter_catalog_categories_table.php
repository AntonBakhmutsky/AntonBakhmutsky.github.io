<?php

use App\Helpers;
use App\Models\CatalogCategory;
use Illuminate\Database\Migrations\Migration;

class AlterCatalogCategoriesTable extends Migration
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
      'text_position',
      [CatalogCategory::TEXT_TOP_POSITION, CatalogCategory::TEXT_BOTTOM_POSITION],
      CatalogCategory::TEXT_TOP_POSITION
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Helpers\DB::dropEnumColumn('catalog_categories', 'text_position');
  }
}
