<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers;

class AddShowOnHomeToCatalogProductsTable extends Migration
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
        $table->boolean('show_on_home')->default(false);
        $table->softIndex('show_on_home');
      }
    );

    Schema::drop('homepage_services');

    Helpers\DB::dropImmutablePrimaryFunction('homepage_services');
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
        $table->dropColumn('show_on_home');
      }
    );

    Schema::create('homepage_services', function (Blueprint $table) {
      $table->smallIncrements('id')->generatedAs()->always();
      $table->string('name');
      $table->string('image');
      $table->addColumn('stringArray', 'more_images')->nullable();
      $table->active();
      $table->sort();
      $table->timestampsWithUserAttributes();
      $table->softDeletesWithUserAttributes();
    });

    Helpers\DB::setImmutablePrimary('homepage_services');

    Helpers\DB::createOnUpdateTrigger('homepage_services');
    Helpers\DB::createOnInsertTrigger('homepage_services');
    Helpers\DB::createOnDeleteTrigger('homepage_services');
  }
}
