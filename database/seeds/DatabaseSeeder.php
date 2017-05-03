<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ProductsSeeder::class);
        $this->call(DeliveryTableSeeder::class);
        $this->call(ShippingTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(PickUpTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsSeeder::class);

    }
}
