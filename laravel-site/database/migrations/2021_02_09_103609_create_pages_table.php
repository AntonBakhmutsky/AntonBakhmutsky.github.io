<?php

use App\Helpers;
use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create(
      'pages',
      function (Blueprint $table) {
        $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
        $table->string('name');
        $table->text('html')->nullable();
        $table->string('code')->nullable();
        $table->active();
        $table->string('url')->nullable();
        $table->timestampsWithUserAttributes();
        $table->softDeletesWithUserAttributes();
        $table->softUnique('code');
        $table->softUnique('url');
      }
    );

    Helpers\DB::createEnumColumn('pages', 'text_position', [Page::TEXT_TOP_POSITION, Page::TEXT_BOTTOM_POSITION], Page::TEXT_BOTTOM_POSITION);

    Helpers\DB::setImmutablePrimary('pages');

    Helpers\DB::createOnUpdateTrigger('pages');
    Helpers\DB::createOnInsertTrigger('pages');
    Helpers\DB::createOnDeleteTrigger('pages');
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('pages');
  }
}
