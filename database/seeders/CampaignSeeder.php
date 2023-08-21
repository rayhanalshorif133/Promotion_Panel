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
        ]);

        CampaignDetail::create([
            'campaign_id' => $campaign->id,
            'operator_id' => 1,
            'service_id' => 1,
            'ratio' => 0.4,
            'url' => 'http://localhost:3000/traffic/1/1/GP/{clickedID}/',
            'status' => 'active',
        ]);

        for ($index = 0; $index < 100; $index++) {
            // http://localhost:3000/traffic/1/1/GP/01923988380
            $traffic = new Traffic();
            $traffic->campaign_id = $campaign->id;
            $traffic->service_id = 1;
            $traffic->operator_id = 1 ;
            $traffic->clicked_id = '01923988' . $index;
            $traffic->others = null;
            $traffic->received_at = now();
            $traffic->callback_received_status =  0;
            $traffic->callback_sent_status = 0;
            $traffic->save();
        }
    }
}
