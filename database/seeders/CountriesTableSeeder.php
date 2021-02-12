<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = ['lt','lv','ee','de','es','fr','gb','no','pl','ru','se','us'];
        foreach($countries as $country){
            Country::create([
                'code' => $country,
            ]);
        }
    }
}
