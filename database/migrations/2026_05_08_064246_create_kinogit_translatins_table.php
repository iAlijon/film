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
        Schema::create('kinogit_translatins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kinogit_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('description', 10000);
            $table->string('image');
            $table->text('content');
            $table->string('translates', 2);
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
        Schema::dropIfExists('kinogit_translatins');
    }
};
