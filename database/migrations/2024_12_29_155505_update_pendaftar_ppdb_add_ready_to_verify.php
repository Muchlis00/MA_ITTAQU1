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
        Schema::table('pendaftar_ppdb', function (Blueprint $table) {
            $table->boolean('ready_to_verify')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftar_ppdb', function (Blueprint $table) {
            $table->dropColumn('ready_to_verify');
        });
    }
};
