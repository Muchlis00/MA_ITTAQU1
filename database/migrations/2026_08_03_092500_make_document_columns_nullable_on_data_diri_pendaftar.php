<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fix: Kolom ijazah, photo, dan akte_kelahiran harus nullable
     * karena kolom-kolom ini baru diisi pada tahap 3 (Dokumen Pendaftar),
     * sementara record dibuat pada tahap 1 (Data Pendaftar).
     */
    public function up(): void
    {
        Schema::table('data_diri_pendaftar', function (Blueprint $table) {
            $table->string('ijazah')->nullable()->change();
            $table->string('photo')->nullable()->change();
            $table->string('akte_kelahiran')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_diri_pendaftar', function (Blueprint $table) {
            $table->string('ijazah')->nullable(false)->change();
            $table->string('photo')->nullable(false)->change();
            $table->string('akte_kelahiran')->nullable(false)->change();
        });
    }
};
