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
        Schema::dropIfExists('portret_rejissors');
        Schema::dropIfExists('portrait_actors');
        Schema::dropIfExists('portrait_operators');
        Schema::dropIfExists('portrait_composers');
        Schema::dropIfExists('portrait_artists');
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
