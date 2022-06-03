<?php

use App\Helpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homepage_services');
    }
}
