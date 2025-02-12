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
        Schema::drop('filmography_groups');
        Schema::drop('bookgroups');
        Schema::drop('people_associated_with_the_film_categories');
        Schema::drop('news_categories');
        Schema::drop('user_info_categories');
        Schema::drop('user_categories');
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
