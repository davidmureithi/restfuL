<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('remote_id');
            $table->string('product_url');
            $table->string('main_image');
                $table->string('main_image_url');
                $table->string('mainImageHighRes')->nullable();

            $table->string('name', 20);
            $table->integer('price');
                $table->string('price_formatted', 15);
            $table->integer('discount_price');
                $table->string('discount_price_formatted', 15);

            $table->string('category', 15);
            $table->string('sub_category', 15);
            $table->string('currency', 6);
            $table->string('code', 15);

            $table->string('description', 255);
            $table->string('variants');
            $table->string('related');

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
        Schema::drop('products');
    }
}
