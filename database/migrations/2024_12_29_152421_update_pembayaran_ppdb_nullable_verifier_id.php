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
            $table->dropForeign(['verifier_id']);
            $table->unsignedBigInteger('verifier_id')->nullable()->change();
            $table->foreign('verifier_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran_ppdb', function (Blueprint $table) {
            $table->dropForeign(['verifier_id']);
            $table->unsignedBigInteger('verifier_id')->change();
            $table->foreignId('verifier_id')->constrained('users')->onDelete('cascade')->change();
        });
    }
};
