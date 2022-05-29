<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeders/usersfm.sql');

        DB::statement($sql);

        User::create([
            'name' => 'JOnay Medina',
            'username' => 'jonaymedina',
            'email' => 'jonayjosue@gmail.com',
            'role' => 1,
            'str' => "12345678",
            'password' => bcrypt('12345678'),
        ]);

        // for ($i = 0; $i < 5; $i++) {
        //     $name = $faker->unique()->firstName;
        //     User::create([
        //         'name' => $name . ' ' . $faker->firstName,
        //         'username' => $name,
        //         'email' => $faker->unique()->email,
        //         'role' => 2,
        //         'str' => '12345678',
        //         'password' => bcrypt('12345678'),
        //     ]);
        // }
    }
}
