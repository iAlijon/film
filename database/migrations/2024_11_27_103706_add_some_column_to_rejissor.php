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
//        Schema::table('rejissor', function (Blueprint $table) {
//                $table->integer('people_film_category_id');
//                $table->text('content_oz');
//                $table->text('content_uz');
//                $table->text('content_ru')->nullable();
//                $table->text('content_en')->nullable();
//                $table->boolean('status')->default(true);
//
//                $table->foreign('people_film_category_id')->references('id')->on('people_film_categories');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rejissor', function (Blueprint $table) {
            //
        });
    }
};
