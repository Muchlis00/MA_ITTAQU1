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
        Schema::table('orientasi', function (Blueprint $table) {
            // Drop the old datetime column
            $table->dropColumn('datetime');
            
            // Add the new columns for datetime range
            $table->dateTime('datetime_start')->after('id');
            $table->dateTime('datetime_end')->after('datetime_start');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orientasi', function (Blueprint $table) {
            // Add back the datetime column
            $table->dateTime('datetime')->after('id');
            
            // Drop the new columns
            $table->dropColumn(['datetime_start', 'datetime_end']);
        });
    }
};
