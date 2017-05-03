<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->unique()->nullable();
            $table->string('first_name', 20)->nullable();
            $table->string('last_name', 20)->nullable();
            $table->string('username', 42)->nullable();
            $table->string('email',50)->unique();
            $table->string('password');
            $table->string('password_reset_token')->nullable();

            $table->boolean('status')->nullable();
            $table->string('gender',6)->nullable();
            $table->string('zip')->nullable();
            $table->string('street',20 )->nullable();
            $table->string('city',20)->nullable();
            $table->string('house_number',20)->nullable();
            $table->string('location',200)->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
