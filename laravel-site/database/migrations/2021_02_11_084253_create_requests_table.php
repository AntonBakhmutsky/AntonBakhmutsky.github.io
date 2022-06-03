<?php

use App\Helpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\Request;

class CreateRequestsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create(
      'requests',
      function (Blueprint $table) {
        $table->bigIncrements('id')->generatedAs()->always();
        $table->string('name');
        $table->string('phone', 17);
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent();
        $table->unsignedSmallInteger('created_by')->nullable();
        $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
        $table->unsignedSmallInteger('updated_by')->nullable();
        $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');
        $table->softDeletesWithUserAttributes();
      }
    );

    Helpers\DB::createEnumColumn('requests', 'type', [Request::TYPE_CALL, Request::TYPE_CONSULTATION, Request::TYPE_ORDER], Request::TYPE_CALL, true);
    Helpers\DB::createEnumColumn('requests', 'status', [Request::STATUS_NEW, Request::STATUS_CLOSED, Request::STATUS_CANCELED], Request::STATUS_NEW, true);

    Helpers\DB::setImmutablePrimary('requests');

    Helpers\DB::createOnUpdateTrigger('requests');
    Helpers\DB::createOnInsertTrigger('requests');
    Helpers\DB::createOnDeleteTrigger('requests');
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Helpers\DB::dropEnumColumn('requests', 'type');
    Helpers\DB::dropEnumColumn('requests', 'status');
    Schema::dropIfExists('requests');
  }
}
