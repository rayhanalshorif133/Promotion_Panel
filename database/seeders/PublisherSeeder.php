<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    

    public function __construct()
    {
        $this->run();
    }

    public function run()
    {
        Publisher::create([
            'name' => 'Publisher 1',
            'short_name' => 'pub1',
            'post_back_url' => 'https://postback.com',
            'status' => 'active'
        ]);

        Publisher::create([
            'name' => 'Publisher 2',
            'short_name' => 'pub2',
            'post_back_url' => 'https://postback.com',
            'status' => 'active'
        ]);

        Publisher::create([
            'name' => 'Publisher 3',
            'short_name' => 'pub3',
            'post_back_url' => 'https://postback.com',
            'status' => 'active'
        ]);
    }
}
