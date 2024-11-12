<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('xendit_payments', function (Blueprint $table) {
        $table->decimal('paid_amount', 15, 2)->nullable(); // Kolom untuk jumlah yang dibayar
        $table->string('bank_code')->nullable(); // Kolom untuk kode bank
        $table->timestamp('paid_at')->nullable(); // Kolom untuk waktu pembayaran
        $table->string('payment_channel')->nullable(); // Kolom untuk saluran pembayaran
        $table->string('payment_destination')->nullable(); // Kolom untuk tujuan pembayaran
        $table->string('payment_id')->nullable(); // Kolom untuk ID pembayaran
        $table->boolean('is_high')->default(false); // Kolom untuk menandai pembayaran tinggi
    });
}

public function down()
{
    Schema::table('xendit_payments', function (Blueprint $table) {
        $table->dropColumn(['paid_amount', 'bank_code', 'paid_at', 'payment_channel', 'payment_destination', 'payment_id', 'is_high']);
    });
}

};
