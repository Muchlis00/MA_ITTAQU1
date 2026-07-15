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
            $table->string('rapor_semester_1')->after('nilai_rapor');
            $table->string('rapor_semester_2')->after('rapor_semester_1');
            $table->string('rapor_semester_3')->after('rapor_semester_2');
            $table->string('rapor_semester_4')->after('rapor_semester_3');
            $table->string('rapor_semester_5')->after('rapor_semester_4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_diri_pendaftar', function (Blueprint $table) {
            $table->dropColumn([
                'rapor_semester_1',
                'rapor_semester_2',
                'rapor_semester_3',
                'rapor_semester_4',
                'rapor_semester_5',
            ]);
        });
    }
};
