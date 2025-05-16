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
        Schema::table('sewas', function (Blueprint $table) {
            $table->integer('durasi')->after('tanggal_selesai')->comment('Dalam bulan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sewas', function (Blueprint $table) {
            //
        });
    }
};
