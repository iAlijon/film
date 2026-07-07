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

        Schema::table('calendars', function (Blueprint $table){
            $table->string('date');
            $table->integer('status');
            $table->integer('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
