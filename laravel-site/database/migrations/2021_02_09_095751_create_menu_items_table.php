<?php

use App\Helpers;
use App\Models\MenuItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create(
      'menu_items',
      function (Blueprint $table) {
        $table->smallIncrements('id')->generatedAs()->always();
        $table->string('name');
        $table->string('link')->nullable();
        $table->unsignedSmallInteger('parent_id')->nullable();
        $table->foreign('parent_id')->references('id')->on('menu_items')->onDelete('cascade');
        $table->active();
        $table->sort();
        $table->timestampsWithUserAttributes();
        $table->softDeletesWithUserAttributes();
      }
    );

    Helpers\DB::createEnumColumn('menu_items', 'type', [MenuItem::TYPE_TOP, MenuItem::TYPE_MAIN, MenuItem::TYPE_BOTTOM], MenuItem::TYPE_MAIN, true);

    Helpers\DB::setImmutablePrimary('menu_items');

    Helpers\DB::createOnUpdateTrigger('menu_items');
    Helpers\DB::createOnInsertTrigger('menu_items');
    Helpers\DB::createOnDeleteTrigger('menu_items');

    /* recursion checking */
    DB::statement(
      'create or replace function check_parent_on_menu_items_table() returns trigger
          language plpgsql
      as
      $$
      declare
          level    smallint;
          parentId int;
          parentType menu_item_types;
      begin
          if (NEW.parent_id is not null) then

              level = 10;
              parentId = NEW.parent_id;
              while parentId is not null
                  loop

                      if (level = 0) or (parentId = NEW.id) then
                          raise exception \'Recursion error warning!\' using errcode = \'23001\';
                      end if;

                      select mi.parent_id, mi.type into parentId, parentType from menu_items mi where mi.id = parentId;

                      if (parentType != NEW.type) then
                          raise exception \'Parent type is does not match "%"!\', NEW.type using errcode = \'23001\';
                      end if;

                      level = level - 1;

                  end loop;
          end if;

          return NEW;
      end;
      $$'
    );
    DB::statement(
      'create trigger check_parent_menu
            before insert or update
            on menu_items
            for each row
        execute function check_parent_on_menu_items_table()'
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Helpers\DB::dropEnumColumn('menu_items', 'type');
    Schema::dropIfExists('menu_items');
  }
}
