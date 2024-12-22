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
