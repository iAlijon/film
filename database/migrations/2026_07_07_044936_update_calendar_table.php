<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropColumns('calendars', [
//            'aphorism_id',
//            'description_oz',
//            'description_uz',
//            'description_ru',
//            'description_en',
//        ]);

        Schema::table('calendars', function (Blueprint $table) {
            if (!Schema::hasColumn('calendars', 'date')) {
                $table->string('date');
            }
            if (!Schema::hasColumn('calendars', 'status')) {
                $table->integer('status');
            }
            if (!Schema::hasColumn('calendars', 'order')) {
                $table->integer('order');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendars', function (Blueprint $table) {
            foreach (['date', 'status', 'order'] as $column) {
                if (Schema::hasColumn('calendars', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
