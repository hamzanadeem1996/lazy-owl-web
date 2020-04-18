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
            $table->bigIncrements('id');
            $table->integer('status')->default(1);
            $table->integer('user_id');
            $table->string('transaction_id');
            $table->integer('amount');
            $table->string('email');
            $table->string('receipt_url');
            $table->string('refund_url');
            $table->string('last_four_of_card');
            $table->string('card_exp_year');
            $table->string('card_exp_month');
            $table->string('card_id');
            $table->string('card_brand');
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
