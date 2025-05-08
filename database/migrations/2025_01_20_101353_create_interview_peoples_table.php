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
        Schema::create('interview_peoples', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('full_name_oz');
            $table->string('full_name_uz');
            $table->string('full_name_ru')->nullable();
            $table->string('full_name_en')->nullable();
            $table->string('images');
            $table->longText('description_oz');
            $table->longText('description_uz');
            $table->longText('description_ru')->nullable();
            $table->longText('description_en')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();


            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interview_peoples');
    }
};
