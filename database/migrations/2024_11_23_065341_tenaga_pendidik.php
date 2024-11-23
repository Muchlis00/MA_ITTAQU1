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
        Schema::create('tenaga_pendidik', function (Blueprint $table) {
            $table->id('id_pendidik'); // Primary Key
            $table->foreignId('id')->nullable()->constrained('users')->onDelete('cascade'); // Foreign Key
            $table->string('nip')->unique(); // Kolom NIP
            $table->string('nama_guru'); // Kolom Nama Guru
            $table->string('tempat_guru'); // Tempat Lahir
            $table->date('tgl_guru'); // Tanggal Lahir
            $table->enum('jk_guru', ['Laki-Laki', 'Perempuan']); // Jenis Kelamin
            $table->string('jabatan'); // Jabatan
            $table->timestamps(); // Kolom created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_pendidik');
    }
};
