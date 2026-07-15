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
        Schema::table('data_diri_pendaftar', function (Blueprint $table) {
            $table->string('rapor_semester_6')->after('rapor_semester_5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_diri_pendaftar', function (Blueprint $table) {
            $table->dropColumn('rapor_semester_6');
        });
    }
};
