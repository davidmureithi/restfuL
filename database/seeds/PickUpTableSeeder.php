<?php

use Illuminate\Database\Seeder;

class PickUpTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $limit = 1;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('pickup')->insert([
                'name' => 'Free',
                'currency' => 'KSH',
                'min_cart_amount' => '500',
                'price' => '0',
                'price_formatted' => 'KSH.0.00/=',
                'total_price' => '500',
                'total_price_formatted' => 'KSH.500/=',
                'payment_id' => 1,
            ]);
        }
    }
}