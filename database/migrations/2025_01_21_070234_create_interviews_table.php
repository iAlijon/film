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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->integer('interview_category_id');
            $table->integer('interview_people_id');
            $table->string('interview_oz');
            $table->string('interview_uz');
            $table->string('interview_ru')->nullable();
            $table->string('interview_en')->nullable();
            $table->longText('description_oz');
            $table->longText('description_uz');
            $table->longText('description_ru')->nullable();
            $table->longText('description_en')->nullable();
            $table->text('content_oz');
            $table->text('content_uz');
            $table->text('content_ru')->nullable();
            $table->text('content_en')->nullable();
            $table->string('anchor')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('interview_category_id')->references('id')->on('people_associated_with_the_film_categories')->cascadeOnDelete();
            $table->foreign('interview_people_id')->references('id')->on('interview_peoples')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interviews');
    }
};
