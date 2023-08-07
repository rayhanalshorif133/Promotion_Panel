<?php

namespace Database\Seeders;

use App\Models\Operator;
use Illuminate\Database\Seeder;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


     public function __construct()
     {
         $this->run();
     }

    public function run()
    {
        Operator::create([
            'name' => 'GP',
            'status' => 'active',
        ]);

        Operator::create([
            'name' => 'Robi',
            'status' => 'active',
        ]);
        
        Operator::create([
            'name' => 'Airtel',
            'status' => 'active',
        ]);

        Operator::create([
            'name' => 'B-link',
            'status' => 'active',
        ]);

        Operator::create([
            'name' => 'T-talk',
            'status' => 'active',
        ]);
    }
}
