<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
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
            DB::table('payments')->insert([
                'name' => 'Cash',
                'currency' => 'KSH',
                'description' => $faker->sentence(7),
                'price' => $faker->numberBetween(650),
                'price_formatted' => $faker->numberBetween(650),
                'total_price' => $faker->numberBetween(700),
                'total_price_formatted' => $faker->numberBetween(700),
                'shipping_id' => $faker->numberBetween(1,2),
                'pick_up_id' => $faker->numberBetween(1,2),
            ]);
        }
    }
}
