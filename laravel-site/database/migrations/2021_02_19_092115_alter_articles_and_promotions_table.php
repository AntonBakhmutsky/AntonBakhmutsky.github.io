<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterArticlesAndPromotionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table(
      'articles',
      function (Blueprint $table) {
        $table->string('image')->nullable();
        $table->text('preview')->nullable();
      }
    );
    Schema::table(
      'promotions',
      function (Blueprint $table) {
        $table->string('image')->nullable();
        $table->text('preview')->nullable();
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
      'articles',
      function (Blueprint $table) {
        $table->dropColumn('image');
        $table->dropColumn('preview');
      }
    );
    Schema::table(
      'promotions',
      function (Blueprint $table) {
        $table->dropColumn('image');
        $table->dropColumn('preview');
      }
    );
  }
}
