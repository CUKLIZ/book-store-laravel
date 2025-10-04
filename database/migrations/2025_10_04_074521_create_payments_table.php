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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->dateTime('payment_date')->nullable();
            $table->decimal('amount', 12, 2); // Jumlah yang di bayar
            $table->enum('payment_method', ['credit_card', 'bank_transfer', 'e_wallet', 'cod'])->default('bank_transfer');
            $table->string('payment_proof')->nullable(); // Bukti pembayaran, misalnya URL gambar
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
