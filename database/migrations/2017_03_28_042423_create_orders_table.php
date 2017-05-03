<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');

            $table->string('remote_id');
            $table->string('status');
            $table->integer('total');
            $table->string('total_formatted');

            $table->string('shipping_name');
            $table->integer('shipping_price');
            $table->string('shipping_price_formatted');
            $table->integer('shipping_type');
            $table->integer('payment_type');
            $table->string('payment_id');
            $table->string('currency');

            $table->string('name');
            $table->string('street');
            $table->string('house_number');
            $table->string('city');
            $table->string('region');
            $table->string('zip');
            $table->text('address');
            $table->string('email');
            $table->string('phone');
            $table->string('note');

            $table->text('items');
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
        Schema::dropIfExists('orders');
    }
}
