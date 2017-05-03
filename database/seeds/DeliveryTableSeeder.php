<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        $limit = 2;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('deliveries')->insert([
                'name' => $faker->text(5),
                'currency' => 'KSH',
                'min_cart_amount' => '1000',
                'price' => $faker->randomNumber(),
                'price_formatted' => $faker->randomNumber(),
                'total_price' => $faker->numberBetween(600),
                'total_price_formatted' => $faker->numberBetween(600),
                'payment_id' => 2,

            ]);
        }
    }
}