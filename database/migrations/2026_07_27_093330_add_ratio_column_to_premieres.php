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
        Schema::table('premieres', function (Blueprint $table) {
            $table->integer('width_ratio')->default(16);
            $table->integer('height_ratio')->default(9);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('premieres', function (Blueprint $table) {
            //
        });
    }
};
