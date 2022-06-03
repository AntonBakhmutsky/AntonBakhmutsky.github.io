<?php

use App\Helpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowOnHoneFieldToCatalogCategoriesTable extends Migration
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
        $table->boolean('show_on_home')->default(false);
        $table->softIndex('show_on_home');
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
        $table->dropColumn('show_on_home');
      }
    );
  }
}
