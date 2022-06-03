<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPageSizeToCatalogCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table(
      'catalog_categories',
      function (Blueprint $table) {
        $table->smallInteger('page_size')->default(12);
      }
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table(
      'catalog_categories',
      function (Blueprint $table) {
        $table->dropColumn('page_size');
      }
    );
  }
}
