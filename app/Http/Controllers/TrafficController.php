<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\PostBackReceivedLog;
use App\Models\Publisher;
use App\Models\Service;
use App\Models\Traffic;
use Illuminate\Http\Request;

class TrafficController extends Controller
{

    public function index()
    {
        $traffics = Traffic::with(['campaign', 'service', 'operator'])->get();
        return view('traffic.index', compact('traffics'));
    }

    public function fetchById($id){
        $traffic = Traffic::with(['campaign', 'service', 'operator'])->find($id);
        $traffic->others = json_decode($traffic->others);

        if(!$traffic){
            return $this->respondWithError('Traffic not found.');
        }
        return $this->respondWithSuccess('Traffic found.', $traffic);
    }

    public function redirect($campaignId, $serviceId , $operatorName,  $clickedID, Request $request)
    {

        $data = [
            'campaignId' => $campaignId,
            'serviceId' => $serviceId,
            'operatorName' => $operatorName,
            'clickedID' => $clickedID,
            'others' => $request->all()
        ];

        if (!$campaignId || !$serviceId || !$operatorName) {
            return response()->json([
                'status'   => false,
                'errors'  => true,
                'message'  => 'Please provide campaignId, serviceId, operatorName.',
                'example'     => '/{basedUrl}/{campaignId}/{serviceId}/{operatorName}/{clickedID}/?{others}',
                'data'     => $data
            ], 203);
        }

        if($clickedID == null){
            return $this->respondWithError('Please provide clickedID.',$data);
        }

        $operator = Operator::where('name', $operatorName)->first();
        $service = Service::find($serviceId);

        $traffic = new Traffic();
        $traffic->campaign_id = $campaignId;
        $traffic->service_id = $serviceId;
        $traffic->operator_id = $operator? $operator->id : null;
        $traffic->clicked_id = $clickedID;
        $traffic->others = json_encode($request->all());
        $traffic->received_at = now();
        $traffic->callback_received_status =  0;
        $traffic->callback_sent_status = 0;
        $traffic->save();  
        return redirect($service->traffic_redirect_url);

    }

    // /post-back/{serviceId}/{channel}/{operatorName}/{clickedID}
    public function postBack($serviceId , $channel, $operatorName,  $clickedID, Request $request)
    {

        $traffic = Traffic::select()->where('clicked_id', $clickedID)->first();
        $traffic->callback_received_status =  1;
        $traffic->save();

        // find publisher by short_name like
        $publisher = Publisher::where('short_name', 'like', '%'.$channel.'%')->first();
        $publisher->post_back_url = $request->fullUrl();
        $publisher->save();


        // PostBackReceivedLog
        $postBackReceivedLog = new PostBackReceivedLog();
        $postBackReceivedLog->operator_id = $traffic->operator_id;
        $postBackReceivedLog->service_id = $traffic->service_id;
        $postBackReceivedLog->channel = $channel;
        $postBackReceivedLog->clicked_id = $clickedID;
        $postBackReceivedLog->received_at = now();
        $postBackReceivedLog->save();

        return response()->json([
            'status'   => true,
            'errors'  => false,
            'message'  => 'Post back successfully received.',
        ], 200);

    }
}
