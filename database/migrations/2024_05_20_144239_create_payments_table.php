<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('kendaraan_id');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraan'); 
            $table->string('order_id')->nullable();
            $table->timestamp('purchase_date')->nullable();
            $table->dateTime('transaction_time')->nullable();
            $table->string('transaction_status')->default('settlement');
            $table->string('transaction_id')->nullable();
            $table->text('status_message')->nullable();
            $table->integer('status_code')->nullable();
            $table->string('signature_key')->nullable();
            $table->dateTime('settlement_time')->nullable();
            $table->string('payment_type')->default('gopay');
            $table->decimal('gross_amount', 15, 2)->nullable();
            $table->string('fraud_status')->default('accept');
            $table->string('currency', 10)->default('IDR');
            $table->string('merchant_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
