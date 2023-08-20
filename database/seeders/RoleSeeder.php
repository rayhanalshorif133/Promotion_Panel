<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
     
    public function __construct()
    {
        $this->run();
    }
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'campaign']);
        Permission::create(['name' => 'traffic']);
        Permission::create(['name' => 'operator']);
        Permission::create(['name' => 'country']);
        Permission::create(['name' => 'service']);
        Permission::create(['name' => 'publisher']);
        Permission::create(['name' => 'send-logs']);
        Permission::create(['name' => 'receive-logs']);
        Permission::create(['name' => 'campaign-report']);
    }
}
