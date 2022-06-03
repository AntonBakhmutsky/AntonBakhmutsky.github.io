<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScheduleFieldToCemeteriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table(
      'cemeteries',
      function (Blueprint $table) {
        $table->text('schedule')->nullable();
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
      'cemeteries',
      function (Blueprint $table) {
        $table->dropColumn('schedule');
      }
    );
  }
}
