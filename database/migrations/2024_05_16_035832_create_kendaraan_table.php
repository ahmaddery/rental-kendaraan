<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('category_id');
            $table->string('image')->nullable();
            $table->string('warna');
            $table->year('tahun');
            $table->decimal('harga', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->string('plat_nomor')->unique();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('type')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kendaraan');
    }
}
