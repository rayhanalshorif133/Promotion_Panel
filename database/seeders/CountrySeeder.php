<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function __construct()
     {
         $this->run();
     }

    public function run()
    {
        Country::create([
            'name' => 'United States',
            'status' => 'active',
        ]);

        Country::create([
            'name' => 'United Kingdom',
            'status' => 'active',
        ]);

        Country::create([
            'name' => 'Canada',
            'status' => 'active',
        ]);

        Country::create([
            'name' => 'Australia',
            'status' => 'active',
        ]);

        Country::create([
            'name' => 'New Zealand',
            'status' => 'active',
        ]);

        Country::create([
            'name' => 'Bangladesh',
            'status' => 'active',
        ]);

        Country::create([
            'name' => 'India',
            'status' => 'active',
        ]);

        Country::create([
            'name' => 'Pakistan',
            'status' => 'active',
        ]);

    }
}
