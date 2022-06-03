<?php

use Illuminate\Database\Migrations\Migration;

class CreateCachedImageDir extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $publicPath = public_path(config('image.cache.directory'));
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
    $publicPath = public_path(config('image.cache.directory'));
    if (File::exists($publicPath)) {
      File::deleteDirectory($publicPath);
    }
  }
}
