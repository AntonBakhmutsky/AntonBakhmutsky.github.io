<?php

use App\Helpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_tags', function (Blueprint $table) {
            $table->uuid('item_id')->primary();
            $table->string('title')->nullable();
            $table->string('h1')->nullable();
            $table->string('keywords')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
        });

        Helpers\DB::setImmutablePrimary('meta_tags', 'item_id');
        Helpers\DB::createOnDeleteTrigger('pages');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_tags');
    }
}
