<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductFieldToRequestsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table(
      'requests',
      function (Blueprint $table) {
        $table->foreignUuid('product_id')->nullable()->references('id')->on('catalog_products')->onDelete('restrict');
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
      'requests',
      function (Blueprint $table) {
        $table->dropColumn('product_id');
      }
    );
  }
}
