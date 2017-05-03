<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([ //,

                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName(),
                'username' => $faker->userName,
                'password' => $faker->password(6,12),
                'password_reset_token' => $faker->windowsPlatformToken,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->unique()->phoneNumber,

                'status' => $faker->boolean,
                'gender' => $faker->text(5,6),
                'zip' => $faker->postcode,
                'location' => $faker->address,
                'street' => $faker->streetName,
                'house_number' => $faker->colorName,
                'city' => $faker->city,
            ]);
        }
    }
}
