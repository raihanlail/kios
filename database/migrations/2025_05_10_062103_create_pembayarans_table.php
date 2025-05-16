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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sewa_id')->constrained('sewas')->onDelete('cascade');
            
            $table->decimal('jumlah', 12, 2);
            $table->string('bukti_pembayaran')->nullable();
             $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending'); // pending, approved, rejected
            $table->string('metode_pembayaran')->default('transfer'); // transfer, cash
            $table->date('tanggal_pembayaran');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
