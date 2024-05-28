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
        Schema::create('pengambilan_pengembalian', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('kendaraan_id')->unsigned();
            $table->string('order_id', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->date('tanggal_pengambilan');
            $table->date('tanggal_pengembalian')->nullable();
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengambilan_pengembalian');
    }
};
