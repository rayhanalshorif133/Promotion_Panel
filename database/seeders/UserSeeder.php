<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    
    
    public function __construct()
    {
        $this->run();
    }
    
    
    public function run()
    {

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            ]);

        $admin->assignRole('admin');
        $admin->givePermissionTo(Permission::all());

        $user = User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            ]);
        $user->assignRole('user');
        $user->givePermissionTo('dashboard','campaign','traffic');

        for ($index=0; $index < 20; $index++) { 
            $user = User::create([
                'name' => 'user'.$index,
                'email' => 'user_'.$index . '@gmail.com',
                'password' => Hash::make('password'),
                ]);
            $user->assignRole('user');
            $user->givePermissionTo('dashboard','campaign','traffic');
    
        }
    }
}
