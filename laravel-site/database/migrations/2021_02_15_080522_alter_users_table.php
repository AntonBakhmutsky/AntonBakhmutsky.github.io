<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->softDeletes();
        $table->unsignedSmallInteger('deleted_by')->nullable();
        $table->foreign('deleted_by')->references('id')->on('users')->onDelete('restrict');
        $table->unsignedSmallInteger('created_by')->nullable();
        $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
        $table->unsignedSmallInteger('updated_by')->nullable();
        $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('deleted_at');
        $table->dropColumn('deleted_by');
        $table->dropColumn('created_by');
        $table->dropColumn('updated_by');
      });
    }
}
