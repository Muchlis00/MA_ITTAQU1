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
            $table->string('ijazah')->nullable()->after('previous_school_address');
            $table->string('photo')->nullable()->after('ijazah');
            $table->string('akte_kelahiran')->nullable()->after('photo');
            $table->string('kip')->nullable()->after('akte_kelahiran');
        });

        Schema::table('wali_pendaftar', function (Blueprint $table) {
            $table->string('ktp')->nullable()->after('pendapatan');
            $table->string('kartu_keluarga')->nullable()->after('ktp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_diri_pendaftar', function (Blueprint $table) {
            $table->dropColumn(['ijazah', 'photo', 'akte_kelahiran', 'kip']);
        });

        Schema::table('wali_pendaftar', function (Blueprint $table) {
            $table->dropColumn(['ktp', 'kartu_keluarga']);
        });
    }
};
