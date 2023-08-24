<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\CampaignDetail;
use App\Models\Publisher;
use App\Models\Traffic;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function __construct()
    {
        $this->run();
    }

    public function run()
    {


        $campaign = Campaign::create([
            'publisher_id' => 1,
            'name' => 'Campaign 1',
            'ratio' => 0.4,
            'status' => 'active',
        ]);

        CampaignDetail::create([
            'campaign_id' => $campaign->id,
            'operator_id' => 1,
            'service_id' => 1,
            'url' => 'http://127.0.0.1:8000/traffic/1/1/GP/01923988380',
        ]);

        CampaignDetail::create([
            'campaign_id' => $campaign->id,
            'operator_id' => 2,
            'service_id' => 2,
            'url' => 'http://127.0.0.1:8000/traffic/1/2/Robi/01323174104',
        ]);

    }
}
