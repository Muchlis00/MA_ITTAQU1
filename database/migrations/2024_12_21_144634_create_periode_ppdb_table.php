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
    Schema::create('periode_ppdb', function (Blueprint $table) {
        $table->id('id_periode');
        $table->string('name');
        $table->date('startDate');
        $table->date('endDate');
        $table->timestamps();
    });

    Schema::create('panitia_ppdb', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_periode'); 
        $table->foreign('id_periode')->references('id_periode')->on('periode_ppdb')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });

    Schema::create('bendahara_ppdb', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_periode'); 
        $table->foreign('id_periode')->references('id_periode')->on('periode_ppdb')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });

    Schema::create('pembayaran_ppdb', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_periode'); 
        $table->foreign('id_periode')->references('id_periode')->on('periode_ppdb')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('verifier_id')->constrained('users')->onDelete('cascade');
        $table->string('bukti_pembayaran');
        $table->enum('status_pembayaran', ['Belum Lunas', 'Lunas']);
        $table->timestamps();
    });

    Schema::create('pendaftar_ppdb', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_periode'); 
        $table->foreign('id_periode')->references('id_periode')->on('periode_ppdb')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });

    Schema::create('data_diri_pendaftar', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('telepon');
        $table->string('tempat_lahir');
        $table->date('tgl_lahir');
        $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
        $table->string('nisn');
        $table->string('asal_sekolah');
        $table->string('alamat_sekolah_asal');
        $table->timestamps();
    });

    Schema::create('wali_pendaftar', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pendaftar_id')->constrained('data_diri_pendaftar')->onDelete('cascade');
        $table->string('nama');
        $table->string('alamat');
        $table->string('telepon');
        $table->string('tempat_lahir');
        $table->date('tgl_lahir');
        $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
        $table->string('pekerjaan');
        $table->string('pendapatan');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panitia_ppdb');
        Schema::dropIfExists('periode_ppdb');
    }
};
