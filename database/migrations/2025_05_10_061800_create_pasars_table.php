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
        Schema::create('pasars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasar')->unique();
            $table->string('alamat');
            $table->string('no_telp')->nullable();
            $table->integer('jumlah_kios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasars');
    }
};
