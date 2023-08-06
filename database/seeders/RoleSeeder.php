<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
     
    public function __construct()
    {
        $this->run();
    }
    public function run()
    {
        Role::create(['name' => 'admin']);
    }
}
