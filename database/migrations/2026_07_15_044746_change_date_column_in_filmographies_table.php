<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('filmographies', function (Blueprint $table) {
            // 1-qadam: eski ustunni yangi nom bilan qo'shish
            $table->integer('year')->nullable()->index()->after('date');
        });

        // 2-qadam: ma'lumotni ko'chirish (agar kerak bo'lsa)
//        DB::statement('UPDATE filmographies SET year = date');

        Schema::table('filmographies', function (Blueprint $table) {
            // 3-qadam: eski ustunni o'chirish
            $table->dropColumn('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filmographies', function (Blueprint $table) {

        });
    }
};
