<?php

namespace Database\Seeders;

use App\Models\User;
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
        $faker = \Faker\Factory::create();
        User::create([
                'name' => 'Ernestas',
                'email' => 'ernyszz7@gmail.com',
                'role_id' => 5,
                'password' => bcrypt('00000000'),
            ]);
        foreach(range(1, 50) as $index){
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('00000000'),
            ]);
        }

    }
}
