<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected array $tables = [
        'film_analyses',
        'filmographies',
        'books',
        'kinogits',
        'calendars',
        'aphorisms',
        'categories',
        'dictionary',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $tableSchema) use ($table) {
                    if (!Schema::hasColumn($table, 'width_ratio')) {
                        $tableSchema->integer('width_ratio')->default(16);
                    }
                    if (!Schema::hasColumn($table, 'height_ratio')) {
                        $tableSchema->integer('height_ratio')->default(9);
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $tableSchema) use ($table) {
                    if (Schema::hasColumn($table, 'width_ratio')) {
                        $tableSchema->dropColumn('width_ratio');
                    }
                    if (Schema::hasColumn($table, 'height_ratio')) {
                        $tableSchema->dropColumn('height_ratio');
                    }
                });
            }
        }
    }
};
