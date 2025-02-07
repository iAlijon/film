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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('full_name_oz');
            $table->string('full_name_uz');
            $table->string('full_name_ru')->nullable();
            $table->string('full_name_en')->nullable();
            $table->longText('description_oz');
            $table->longText('description_uz');
            $table->longText('description_ru')->nullable();
            $table->longText('description_en')->nullable();
            $table->text('content_oz');
            $table->text('content_uz');
            $table->text('content_ru')->nullable();
            $table->text('content_en')->nullable();
            $table->string('images');
            $table->boolean('status')->default(true);
            $table->date('birth_date');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('person_categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};
