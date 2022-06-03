<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUtmToRequestsTable extends Migration
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
        $table->string('utm_source', 500)->nullable();
        $table->string('utm_medium', 500)->nullable();
        $table->string('utm_campaign', 500)->nullable();
        $table->string('utm_term', 500)->nullable();
        $table->string('utm_content', 500)->nullable();
        $table->string('referer', 500)->nullable();
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
        $table->dropColumn('utm_source');
        $table->dropColumn('utm_medium');
        $table->dropColumn('utm_campaign');
        $table->dropColumn('utm_term');
        $table->dropColumn('utm_content');
        $table->dropColumn('referer');
      }
    );
  }
}
