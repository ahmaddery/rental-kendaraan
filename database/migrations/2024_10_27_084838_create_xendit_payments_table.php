<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXenditPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('xendit_payments', function (Blueprint $table) {
            $table->id(); // Kolom id utama
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('kendaraan_id'); // Pastikan ini unsignedBigInteger
            $table->foreign('kendaraan_id')->references('id')->on('kendaraan')->onDelete('cascade'); // Foreign key

            $table->string('external_id')->unique();
            $table->string('merchant_name');
            $table->string('merchant_profile_picture_url')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('payer_email')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->string('invoice_url')->nullable();
            $table->string('status')->default('PENDING');
            $table->string('currency')->default('IDR');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('xendit_payments');
    }
}
