<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table){
            $table->increments('id');
            $table->string('currency');
            $table->string('name');
            $table->string('description');
            $table->string('price');
            $table->string('price_formatted');
            $table->string('total_price');
            $table->string('total_price_formatted');
            $table->string('shipping_id');
            $table->string('pick_up_id');
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
