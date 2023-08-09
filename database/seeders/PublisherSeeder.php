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
            'name' => 'Marvel',
            'short_name' => 'marvel',
            'post_back_url' => 'https://www.marvel.com/',
            'status' => 'active'
        ]);
    }
}
