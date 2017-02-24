<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('category');
            $table->string('location');

            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('about');

            $table->decimal('longitude', 11, 8);
            $table->decimal('latitude', 10, 8);

            $table->timestamps();
        });
    }

    public function down(){
        Schema::drop('agents');
    }
}
