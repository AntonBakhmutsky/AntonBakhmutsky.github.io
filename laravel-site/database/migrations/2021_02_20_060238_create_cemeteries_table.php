<?php

use App\Helpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCemeteriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create(
      'cemeteries',
      function (Blueprint $table) {
        $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
        $table->string('name');
        $table->string('code');
        $table->string('address')->nullable();
        $table->jsonb('coordinates')->nullable();
        $table->addColumn('stringArray', 'phones')->nullable();
        $table->text('html')->nullable();
        $table->active();
        $table->sort();
        $table->timestampsWithUserAttributes();
        $table->softDeletesWithUserAttributes();
        $table->softUnique('code');
      }
    );

    Helpers\DB::setImmutablePrimary('cemeteries');

    Helpers\DB::createOnUpdateTrigger('cemeteries');
    Helpers\DB::createOnInsertTrigger('cemeteries');
    Helpers\DB::createOnDeleteTrigger('cemeteries');
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('cemeteries');
  }
}
