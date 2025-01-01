<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    if (!Schema::hasColumn('pendaftar_ppdb', 'verification_status')) {
        Schema::table('pendaftar_ppdb', function (Blueprint $table) {
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])
                  ->default('pending')
                  ->after('ready_to_verify');
        });
    }

    if (!Schema::hasColumn('pendaftar_ppdb', 'verifier_id')) {
        Schema::table('pendaftar_ppdb', function (Blueprint $table) {
            $table->unsignedBigInteger('verifier_id')->nullable()->after('verification_status');
            $table->foreign('verifier_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}


    public function down(): void
    {
        Schema::table('pendaftar_ppdb', function (Blueprint $table) {
            $table->dropColumn('verification_status');
            $table->dropColumn('verifier_id');
        });
    }
};
