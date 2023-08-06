<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    

    public function __construct()
    {
        $this->run();
    }


    public function run()
    {
        User::create([ // 1
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            ]);
    }
}
