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
        Schema::table('news', function (Blueprint $table) {
            $table->boolean('telegram_status')->default(false);
            $table->bigInteger('message_id')->nullable();
        });
        Schema::table('premieres', function (Blueprint $table) {
            $table->boolean('telegram_status')->default(false);
            $table->bigInteger('message_id')->nullable();
        });
        Schema::table('film_analyses', function (Blueprint $table) {
            $table->boolean('telegram_status')->default(false);
            $table->bigInteger('message_id')->nullable();
        });
        Schema::table('interviews', function (Blueprint $table) {
            $table->boolean('telegram_status')->default(false);
            $table->bigInteger('message_id')->nullable();
        });
        Schema::table('people', function (Blueprint $table) {
            $table->boolean('telegram_status')->default(false);
            $table->bigInteger('message_id')->nullable();
        });
        Schema::table('film_dictionaries', function (Blueprint $table) {
            $table->boolean('telegram_status')->default(false);
            $table->bigInteger('message_id')->nullable();
        });
        Schema::table('cinema_facts', function (Blueprint $table) {
            $table->boolean('telegram_status')->default(false);
            $table->bigInteger('message_id')->nullable();
        });
        Schema::table('filmographies', function (Blueprint $table) {
            $table->boolean('telegram_status')->default(false);
            $table->bigInteger('message_id')->nullable();
        });
        Schema::table('books', function (Blueprint $table) {
            $table->boolean('telegram_status')->default(false);
            $table->bigInteger('message_id')->nullable();
        });
        Schema::table('telegram_users', function (Blueprint $table) {
            $table->bigInteger('message_id')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            //
        });
    }
};
