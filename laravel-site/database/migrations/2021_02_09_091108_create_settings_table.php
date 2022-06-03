<?php

use App\Helpers;
use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'settings',
            function (Blueprint $table) {
                $table->string('code')->primary();
                $table->text('value')->nullable();
                $table->timestampsWithUserAttributes();
                $table->softDeletesWithUserAttributes();
            }
        );

        Helpers\DB::createEnumColumn('settings', 'type', [Setting::TYPE_TEXT, Setting::TYPE_STRING, Setting::TYPE_BOOL], Setting::TYPE_STRING);

        Helpers\DB::createOnUpdateTrigger('settings');
        Helpers\DB::createOnInsertTrigger('settings');
        Helpers\DB::createOnDeleteTrigger('settings');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Helpers\DB::dropEnumColumn('settings', 'type');
        Schema::dropIfExists('settings');
    }
}
