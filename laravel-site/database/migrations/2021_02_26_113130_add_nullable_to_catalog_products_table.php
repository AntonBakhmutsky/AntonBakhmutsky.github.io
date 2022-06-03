<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToCatalogProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table(
      'catalog_products',
      function (Blueprint $table) {
        $table->string('code')->nullable()->change();
        $table->string('vendor_code')->nullable();
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
      'catalog_products',
      function (Blueprint $table) {
        $table->string('code')->nullable(false)->change();
        $table->dropColumn('vendor_code');
      }
    );
  }
}
