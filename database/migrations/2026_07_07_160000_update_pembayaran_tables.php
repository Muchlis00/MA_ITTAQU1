<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update pembayaran_ppdb enum from 40% to 50%
        // Step 1: Temporarily expand enum to allow both 40% and 50%
        Schema::table('pembayaran_ppdb', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Belum Lunas', '40%', '50%', 'Lunas'])->default('Belum Lunas')->change();
        });

        // Step 2: Update all existing '40%' values to '50%'
        DB::table('pembayaran_ppdb')->where('status_pembayaran', '40%')->update(['status_pembayaran' => '50%']);

        // Step 3: Modify enum to remove '40%'
        Schema::table('pembayaran_ppdb', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Belum Lunas', '50%', 'Lunas'])->default('Belum Lunas')->change();
        });

        // 2. Update informasi_pembayaran table
        Schema::table('informasi_pembayaran', function (Blueprint $table) {
            $table->text('detail_pembayaran')->nullable()->change();
            $table->json('biaya_administrasi')->nullable();
            $table->json('biaya_atribut')->nullable();
            $table->integer('minimal_pembayaran_pertama')->default(50);
            $table->bigInteger('potongan_lunas')->default(150000);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Revert informasi_pembayaran table
        Schema::table('informasi_pembayaran', function (Blueprint $table) {
            $table->dropColumn([
                'biaya_administrasi',
                'biaya_atribut',
                'minimal_pembayaran_pertama',
                'potongan_lunas'
            ]);
            $table->text('detail_pembayaran')->nullable(false)->change();
        });

        // 2. Revert pembayaran_ppdb enum from 50% to 40%
        Schema::table('pembayaran_ppdb', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Belum Lunas', '40%', '50%', 'Lunas'])->default('Belum Lunas')->change();
        });

        DB::table('pembayaran_ppdb')->where('status_pembayaran', '50%')->update(['status_pembayaran' => '40%']);

        Schema::table('pembayaran_ppdb', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Belum Lunas', '40%', 'Lunas'])->default('Belum Lunas')->change();
        });
    }
};
