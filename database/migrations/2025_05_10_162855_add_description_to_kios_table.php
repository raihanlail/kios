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
        Schema::table('kios', function (Blueprint $table) {
            $table->string('description')->nullable()->after('lokasi'); // Add description column after lokasi
            // You can also use $table->text('description')->nullable(); if you want a larger text field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kios', function (Blueprint $table) {
            //
        });
    }
};
