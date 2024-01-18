<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('affiliations', function (Blueprint $table) {
            $table->string('title_ru')->after('id');
            $table->string('abbreviation_ru')->after('title_ru')->nullable();
            $table->string('title_en')->after('abbreviation_ru')->nullable();
            $table->string('abbreviation_en')->after('title_en')->nullable();

            $table->dropColumn('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliations', function (Blueprint $table) {
            $table->string('title')->after('id');

            $table->dropColumn('title_ru');
            $table->dropColumn('abbreviation_ru');
            $table->dropColumn('title_en');
            $table->dropColumn('abbreviation_en');
        });
    }
};
