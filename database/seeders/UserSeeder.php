<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        User::create([
            'name' => 'JOnay Medina',
            'username' => 'jonaymedina',
            'email' => 'joanyjosue@gmail.com',
            'role' => 1,
            'str' => "12345678",
            'password' => bcrypt('12345678'),
        ]);

        for ($i = 0; $i < 5; $i++) {
            $name = $faker->unique()->firstName;
            User::create([
                'name' => $name . ' ' . $faker->firstName,
                'username' => $name,
                'email' => $faker->unique()->email,
                'role' => 2,
                'str' => '12345678',
                'password' => bcrypt('12345678'),
            ]);
        }
    }
}
