<?php

use App\Helpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create(
      'promotions',
      function (Blueprint $table) {
        $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
        $table->string('name');
        $table->string('code');
        $table->text('html')->nullable();
        $table->boolean('show_on_home')->default(false);
        $table->dateTime('date_from')->nullable();
        $table->dateTime('date_to')->nullable();
        $table->active();
        $table->sort();
        $table->timestampsWithUserAttributes();
        $table->softDeletesWithUserAttributes();
        $table->softIndex('show_on_home');
      }
    );

    Helpers\DB::setImmutablePrimary('promotions');

    Helpers\DB::createOnUpdateTrigger('promotions');
    Helpers\DB::createOnInsertTrigger('promotions');
    Helpers\DB::createOnDeleteTrigger('promotions');
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('promotions');
  }
}
