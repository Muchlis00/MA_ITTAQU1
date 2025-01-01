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
        Schema::create('orientasi', function (Blueprint $table) {
            $table->id();
            $table->dateTime('datetime');
            $table->string('kegiatan');
            $table->string('keterangan');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('id_periode');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_periode')->references('id_periode')->on('periode_ppdb')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orientasi');
    }
};
