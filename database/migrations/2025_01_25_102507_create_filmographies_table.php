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
        Schema::create('filmographies', function (Blueprint $table) {
            $table->id();
            $table->string('name_oz');
            $table->string('name_uz');
            $table->string('name_ru')->nullable();
            $table->string('name_en')->nullable();
            $table->string('images');
            $table->longText('description_oz');
            $table->longText('description_uz');
            $table->longText('description_ru')->nullable();
            $table->longText('description_en')->nullable();
            $table->text('content_oz');
            $table->text('content_uz');
            $table->text('content_ru')->nullable();
            $table->text('content_en')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filmographies');
    }
};
