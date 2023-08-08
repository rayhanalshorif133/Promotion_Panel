<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function __construct()
    {
        $this->run();
    }

    
    public function run()
    {
        new RoleSeeder();
        new UserSeeder();
        new OperatorSeeder();
        new CountrySeeder();
    }
}
