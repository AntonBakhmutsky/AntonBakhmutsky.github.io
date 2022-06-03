<?php

use App\Helpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueIndexesToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('articles', function (Blueprint $table) {
        $table->softUnique('code');
      });
      Schema::table('promotions', function (Blueprint $table) {
        $table->softUnique('code');
      });
      Schema::table('users', function (Blueprint $table) {
        $table->dropUnique(['email']);
        $table->softUnique('email');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('articles', function (Blueprint $table) {
        $table->dropSoftUnique(['code']);
      });
      Schema::table('promotions', function (Blueprint $table) {
        $table->dropSoftUnique(['code']);
      });
      Schema::table('users', function (Blueprint $table) {
        $table->dropSoftUnique(['email']);
        $table->string('email')->unique()->change();
      });
    }
}
