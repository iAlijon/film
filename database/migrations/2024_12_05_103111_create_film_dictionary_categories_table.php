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
        Schema::create('film_dictionary_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('film_dictionary_id');
            $table->integer('dictionary_category_id');
            $table->timestamps();

            $table->foreign('film_dictionary_id')->references('id')->on('film_dictionaries');
            $table->foreign('dictionary_category_id')->references('id')->on('dictionary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_dictionary_categories');
    }
};
