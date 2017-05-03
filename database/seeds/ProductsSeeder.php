<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 33;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('products')->insert([
                'remote_id' => $faker->numberBetween(100, 100000),
                'product_url' => $faker->url(),
                'name' => $faker->text(6,10),
                'price' => $faker->numberBetween(640,4800),
                'price_formatted' => $faker->numberBetween(640,4800),
                'discount_price' => $faker->numberBetween(100,200),
                'discount_price_formatted' => $faker->numberBetween(100,500),
                'category' => $faker->colorName,
                'sub_category' => $faker->safeColorName,
                'currency' => $faker->text(5),
                'code' => $faker->text(10),
                'description' => $faker->sentence(),
                'main_image' => $faker->image(),
                'main_image_url' => $faker->imageUrl(),
                'mainImageHighRes' => $faker->imageUrl(),
                'variants' => $faker->sentence(),
                'related' => $faker->streetAddress,
            ]);
        }
    }
}
