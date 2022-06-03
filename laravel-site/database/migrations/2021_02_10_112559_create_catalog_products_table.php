<?php

use App\Helpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create(
      'catalog_products',
      function (Blueprint $table) {
        $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
        $table->string('name');
        $table->string('image')->nullable();
        $table->addColumn('stringArray', 'more_images')->nullable();
        $table->string('code');
        $table->text('html')->nullable();
        $table->float('price')->nullable();
        $table->sort();
        $table->active();
        $table->timestampsWithUserAttributes();
        $table->softDeletesWithUserAttributes();
        $table->softUnique('code');
      }
    );

    Helpers\DB::setImmutablePrimary('catalog_products');

    Helpers\DB::createOnUpdateTrigger('catalog_products');
    Helpers\DB::createOnInsertTrigger('catalog_products');
    Helpers\DB::createOnDeleteTrigger('catalog_products');

    Schema::create(
      'catalog_product_to_category',
      function (Blueprint $table) {
        $table->foreignUuid('category_id')->references('id')->on('catalog_categories')->onDelete('restrict');
        $table->foreignUuid('product_id')->references('id')->on('catalog_products')->onDelete('restrict');
        $table->primary(['category_id', 'product_id']);
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
    Schema::dropIfExists('catalog_product_to_category');
    Schema::dropIfExists('catalog_products');
  }
}
