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
//        Schema::create('calendar_translates', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('calendar_id')->index()->constrained()->cascadeOnDelete();
//            $table->string('description', 1000);
//            $table->string('translates')->index();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_translates');
    }
};
