<?php

use App\Helpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDbFunctions extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::statement('create extension if not exists "uuid-ossp"');

    Helpers\DB::createOnUpdateFunction();
    Helpers\DB::createOnDeleteFunction();
    Helpers\DB::createOnInsertFunction();

    Helpers\DB::createJsonToArrayFunction();

    $publicPath = public_path(config('sleeping_owl.imagesUploadDirectory'));
    if (! File::exists($publicPath)) {
      File::makeDirectory($publicPath);
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    $publicPath = public_path(config('sleeping_owl.imagesUploadDirectory'));
    if (File::exists($publicPath)) {
      File::deleteDirectory($publicPath);
    }

    Helpers\DB::dropJsonToArrayFunction();

    Helpers\DB::dropOnInsertFunction();
    Helpers\DB::dropOnUpdateFunction();
    Helpers\DB::dropOnDeleteFunction();

    DB::statement('drop extension if exists "uuid-ossp"');

    Schema::dropAllTypes();
  }
}
