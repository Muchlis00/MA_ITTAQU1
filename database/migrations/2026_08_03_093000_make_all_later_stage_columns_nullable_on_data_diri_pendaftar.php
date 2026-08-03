<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fix: Kolom nilai_rapor dan rapor_semester_1 s/d 6 harus nullable
     * karena kolom-kolom ini baru diisi pada tahap 2 (Nilai Rapor) dan tahap 3 (Dokumen Pendaftar),
     * sementara record dibuat pada tahap 1 (Data Pendaftar).
     */
    public function up(): void
    {
        Schema::table('data_diri_pendaftar', function (Blueprint $table) {
            $table->json('nilai_rapor')->nullable()->change();
            $table->string('rapor_semester_1')->nullable()->change();
            $table->string('rapor_semester_2')->nullable()->change();
            $table->string('rapor_semester_3')->nullable()->change();
            $table->string('rapor_semester_4')->nullable()->change();
            $table->string('rapor_semester_5')->nullable()->change();
            $table->string('rapor_semester_6')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_diri_pendaftar', function (Blueprint $table) {
            $table->json('nilai_rapor')->nullable(false)->change();
            $table->string('rapor_semester_1')->nullable(false)->change();
            $table->string('rapor_semester_2')->nullable(false)->change();
            $table->string('rapor_semester_3')->nullable(false)->change();
            $table->string('rapor_semester_4')->nullable(false)->change();
            $table->string('rapor_semester_5')->nullable(false)->change();
            $table->string('rapor_semester_6')->nullable(false)->change();
        });
    }
};
