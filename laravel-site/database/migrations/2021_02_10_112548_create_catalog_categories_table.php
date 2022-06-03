<?php

use App\Helpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create(
      'catalog_categories',
      function (Blueprint $table) {
        $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
        $table->string('name');
        $table->uuid('parent_id')->nullable();
        $table->string('image')->nullable();
        $table->string('code');
        $table->text('html')->nullable();
        $table->sort();
        $table->active();
        $table->timestampsWithUserAttributes();
        $table->softDeletesWithUserAttributes();
        $table->softUnique('code');
      }
    );
    Schema::table(
      'catalog_categories',
      function (Blueprint $table) {
        $table->foreign('parent_id')->references('id')->on('catalog_categories')->onDelete('restrict');
      }
    );

    Helpers\DB::setImmutablePrimary('catalog_categories');

    Helpers\DB::createOnUpdateTrigger('catalog_categories');
    Helpers\DB::createOnInsertTrigger('catalog_categories');
    Helpers\DB::createOnDeleteTrigger('catalog_categories');

    /* recursion checking */
    DB::statement(
      'create or replace function check_parent_on_menu_catalog_categories_table() returns trigger
                language plpgsql
            as
            $$
            declare
                level    smallint;
                parentId uuid;
            begin
                if (NEW.parent_id is not null) then

                    level = 10;
                    parentId = NEW.parent_id;
                    while parentId is not null
                        loop

                            if (level = 0) or (parentId = NEW.id) then
                                raise exception \'Recursion error warning!\' using errcode = \'23001\';
                            end if;

                            select cc.parent_id
                            into parentId
                            from catalog_categories cc
                            where cc.id = parentId;

                            level = level - 1;

                        end loop;

                end if;

                return NEW;
            end;
            $$'
    );
    DB::statement(
      'create trigger check_parent_category
            before insert or update
            on catalog_categories
            for each row
        execute function check_parent_on_menu_catalog_categories_table()'
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('catalog_categories');
  }
}
