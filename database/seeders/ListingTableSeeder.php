<?php

namespace Database\Seeders;

use App\Models\Listing;
use Illuminate\Database\Seeder;

class ListingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $types = ['driver', 'passenger'];
        foreach(range(1, 50) as $index){
            Listing::create(
                [
                    'from' => $faker->city,
                    'to' => $faker->city,
                    'user_id' => rand(1,50),
                    'country_id' => rand(1, 6),
                    'departure' => $faker->dateTimeBetween($startDate = '-1 month', $endDate = '+1 month', $timezone = null),
                    'type' => $types[rand(0,1)],
                    'price' => rand(1,30),
                    'seats' => rand(1,9),
                    'phone' => '+370'.rand(10000000, 99999999),
                ]
            );
        }

    }
}
