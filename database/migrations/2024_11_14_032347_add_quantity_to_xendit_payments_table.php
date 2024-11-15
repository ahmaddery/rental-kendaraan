<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityToXenditPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('xendit_payments', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('currency'); // Adjust position if needed
        });
    }

    public function down()
    {
        Schema::table('xendit_payments', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
}
