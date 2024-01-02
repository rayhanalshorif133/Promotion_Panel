<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignDetail;
use App\Models\Operator;
use App\Models\PostBackReceivedLog;
use App\Models\PostBackSentLog;
use App\Models\Publisher;
use App\Models\Service;
use App\Models\Traffic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignReportController extends Controller
{

    protected $start_date,$end_date;

    // summaryReport
    public function index(Request $request)
    {
        $operators = Operator::all();
        if($request->fetch == 'true'){
            // 2024-01-01 00:00:00.000000
            $start_date = $request->start_date . ' 00:00:00';
            $end_date = $request->end_date . ' 23:59:59';
            $this->start_date = $start_date;
            $this->end_date = $end_date;

            // dd($request->start_date);

            $campaigns = Campaign::with('campaignDetails')->get();
            foreach($campaigns as $campaign){
                $campaign->traffic_received = $this->trafficReceived($campaign->id);
                $campaign->postback_received = $this->postBackReceived($campaign->id);
                $campaign->postback_sent = $this->postBackSent($campaign->id);
            }

            $totals = [
                'traffic_received' => $this->totalTrafficReceived(),
                'postback_received' => $this->totalPostBackReceived(),
                'postback_sent' => $this->totalPostBackSent(),
            ];


            $data = [
                'campaigns' => $campaigns,
                'total_count' => $totals,
            ];
            return $this->respondWithSuccess('Successfully fetched campaign summary report',$data);
        }else{
            return view('campaigns.summary_report', compact('operators'));
        }
    }



    // trafficReceived
    public function trafficReceived($campaign_id)
    {
        $operators = Operator::all();
        $traffic_received = [];



        foreach($operators as $operator){

            $traffic_received_count = Traffic::whereBetween('received_at', [$this->start_date, $this->end_date])
                ->where('campaign_id', $campaign_id)
                ->where('operator_id', $operator->id)
                ->get();
            $data = [
                'operator_id' => $operator->id,
                'operator_name' => $operator->name,
                'count' => $traffic_received_count->count(),
            ];
            $traffic_received[] = $data;
        }
        return $traffic_received;
    }

    // postbackReceived
    public function postBackReceived($campaign_id)
    {
        $operators = Operator::all();
        $postback_received = [];
        foreach($operators as $operator){


            $postback_received_count = PostBackReceivedLog::whereBetween('received_at',[$this->start_date, $this->end_date])
                ->where('campaign_id', $campaign_id)
                ->where('operator_id', $operator->id)
                ->get();
            $data = [
                'operator_id' => $operator->id,
                'operator_name' => $operator->name,
                'count' => $postback_received_count->count(),
            ];
            $postback_received[] = $data;
        }
        return $postback_received;
    }

    // postBackSent
    public function postBackSent($campaign_id)
    {
        $operators = Operator::all();
        $postback_send = [];
        foreach($operators as $operator){


            $postback_send_count = PostBackSentLog::whereBetween('sent_at',[$this->start_date, $this->end_date])
                ->where('campaign_id', $campaign_id)
                ->where('operator_id', $operator->id)
                ->get();
            $data = [
                'operator_id' => $operator->id,
                'operator_name' => $operator->name,
                'count' => $postback_send_count->count(),
            ];
            $postback_send[] = $data;
        }
        return $postback_send;
    }


     // totalTrafficReceived
     public function totalTrafficReceived()
     {
         $operators = Operator::all();
         $traffic_received = [];
         foreach($operators as $operator){
             $traffic_received_count = Traffic::whereBetween('received_at',[$this->start_date, $this->end_date])
                 ->where('operator_id', $operator->id)
                 ->get();
             $data = [
                 'operator_id' => $operator->id,
                 'operator_name' => $operator->name,
                 'count' => $traffic_received_count->count(),
             ];
             $traffic_received[] = $data;
         }
         return $traffic_received;
     }

     // totalPostBackReceived
     public function totalPostBackReceived()
     {
         $operators = Operator::all();
         $postback_received = [];
         foreach($operators as $operator){
             $postback_received_count = PostBackReceivedLog::whereBetween('received_at',[$this->start_date, $this->end_date])
                 ->where('operator_id', $operator->id)
                 ->get();
             $data = [
                 'operator_id' => $operator->id,
                 'operator_name' => $operator->name,
                 'count' => $postback_received_count->count(),
             ];
             $postback_received[] = $data;
         }
         return $postback_received;
     }

     // totalPostBackSent
     public function totalPostBackSent()
     {
         $operators = Operator::all();
         $postback_send = [];
         foreach($operators as $operator){

             $postback_send_count = PostBackSentLog::whereBetween('sent_at',[$this->start_date, $this->end_date])
                 ->where('operator_id', $operator->id)
                 ->get();
             $data = [
                 'operator_id' => $operator->id,
                 'operator_name' => $operator->name,
                 'count' => $postback_send_count->count(),
             ];
             $postback_send[] = $data;
         }
         return $postback_send;
     }




}
