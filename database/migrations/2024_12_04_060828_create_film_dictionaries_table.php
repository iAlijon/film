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
        Schema::create('film_dictionaries', function (Blueprint $table) {
            $table->id();
            $table->string('name_oz');
            $table->string('name_uz');
            $table->string('name_ru')->nullable();
            $table->string('name_en')->nullable();
            $table->string('images')->nullable();
            $table->mediumText('description_oz');
            $table->mediumText('description_uz');
            $table->mediumText('description_ru')->nullable();
            $table->mediumText('description_en')->nullable();
            $table->integer('status')->default(1);
            $table->text('content_oz');
            $table->text('content_uz');
            $table->text('content_ru')->nullable();
            $table->text('content_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_dictionaries');
    }
};
