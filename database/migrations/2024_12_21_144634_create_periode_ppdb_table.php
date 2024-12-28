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
        $table->enum('gender', ['Laki-Laki', 'Perempuan']);
        $table->string('place_of_birth');
        $table->date('date_of_birth');
        $table->string('nisn')->unique();
        $table->string('phone');
        $table->string('child_number');
        $table->string('sibling');
        $table->string('previous_school_name');
        $table->string('previous_school_address');
        $table->timestamps();
    });

    Schema::create('wali_pendaftar', function (Blueprint $table) {
        $table->id();
        $table->foreignId('data_diri_pendaftar_id')->constrained('data_diri_pendaftar')->onDelete('cascade');
        $table->string('name');
        $table->string('address');
        $table->string('phone');
        $table->string('place_of_birth');
        $table->date('date_of_birth');
        $table->enum('gender', ['Laki-Laki', 'Perempuan']);
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
