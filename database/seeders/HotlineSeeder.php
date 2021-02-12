<?php

namespace Database\Seeders;

use App\Models\HotlineMessage;
use Illuminate\Database\Seeder;

class HotlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach(range(1, 50) as $index){
            HotlineMessage::create(
                [
                    'user_id' => rand(1,50),
                    'message' => $faker->sentence(5),
                ]
            );
        }
    }
}
