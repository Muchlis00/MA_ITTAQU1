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
        Schema::table('pembayaran_ppdb', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Belum Lunas', '40%', 'Lunas'])->default('Belum Lunas')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran_ppdb', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Lunas', 'Belum Lunas'])->default('Belum Lunas')->change();
        });
    }
};
