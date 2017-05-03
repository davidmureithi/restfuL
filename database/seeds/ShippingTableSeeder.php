<?php

use Illuminate\Database\Seeder;

class ShippingTableSeeder extends Seeder
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
            DB::table('shipping')->insert([
                'name' => 'Delivery',
                'currency' => 'KSH',
                'min_cart_amount' => '1000',
                'price' => '200',
                'price_formatted' => 'KSH.200.00/=',
                'total_price' => $faker->numberBetween(1200),
                'total_price_formatted' => $faker->numberBetween(1200),
                'payment_id' => 2,

            ]);
        }
    }
}
