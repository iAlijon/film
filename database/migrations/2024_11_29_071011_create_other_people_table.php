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
        Schema::create('other_people', function (Blueprint $table) {
            $table->id();
            $table->integer('people_film_category_id');
            $table->string('name_oz');
            $table->string('name_uz');
            $table->string('name_ru')->nullable();
            $table->string('name_en')->nullable();
            $table->longText('description_oz');
            $table->longText('description_uz');
            $table->longText('description_ru')->nullable();
            $table->longText('description_en')->nullable();
            $table->text('content_oz');
            $table->text('content_uz');
            $table->text('content_ru')->nullable();
            $table->text('content_en')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('people_film_category_id')->references('id')->on('people_film_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_people');
    }
};
