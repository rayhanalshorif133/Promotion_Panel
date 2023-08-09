<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
   
    public function __construct()
    {
        $this->run();
    }



    public function run()
    {
        Service::create([
            'name' => 'MFC',
            'type' => 'daily',
            'traffic_redirect_url' => 'http://mfc.b2mwap.com/index.php/home/home',
            'status' => 'active',
        ]);
        Service::create([
            'name' => 'CFC',
            'type' => 'daily',
            'traffic_redirect_url' => 'http://cfc.b2mwap.com/',
            'status' => 'active',
        ]);
        
        Service::create([
            'name' => 'Chayachobi',
            'type' => 'daily',
            'traffic_redirect_url' => 'http://chayachobi.co/',
            'status' => 'active',
        ]);
    }
}
