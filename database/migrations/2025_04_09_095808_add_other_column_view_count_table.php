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
        Schema::table('premieres', function (Blueprint $table){
            $table->bigInteger('view_count')->default(0);
        });
        Schema::table('cinema_facts', function (Blueprint $table){
            $table->bigInteger('view_count')->default(0);
        });
        Schema::table('dictionary', function (Blueprint $table){
            $table->bigInteger('view_count')->default(0);
        });
        Schema::table('film_analyses', function (Blueprint $table){
            $table->bigInteger('view_count')->default(0);
        });
        Schema::table('filmographies', function (Blueprint $table){
            $table->bigInteger('view_count')->default(0);
        });
        Schema::table('books', function (Blueprint $table){
            $table->bigInteger('view_count')->default(0);
        });
        Schema::table('interviews', function (Blueprint $table){
            $table->bigInteger('view_count')->default(0);
        });
        Schema::table('people', function (Blueprint $table){
            $table->bigInteger('view_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
