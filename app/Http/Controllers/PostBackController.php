<?php

namespace App\Http\Controllers;

use App\Models\PostBackReceivedLog;
use App\Models\PostBackSentLog;
use App\Models\Traffic;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Publisher;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PostBackController extends Controller
{
    // http://promotion.b2mwap.com/traffic/post-back/{serviceId}/{channel}/{operatorName}/{clickedID}
    // http://promotion.b2mwap.com/traffic/post-back/1/marvel/GP/+8801323174104
    //  http://promotion.b2mwap.com/api/traffic/post-back/BDG/marvel/gp/12313
     public function postBack($serviceName, $channel, $operatorName,  $clickedID, Request $request)
     {
         try {
             $service = Service::where('name', 'like', '%' . $serviceName . '%')->first();
 
             $traffic = Traffic::select()
                    ->where('clicked_id', $clickedID)
                    ->where('service_id', $service->id)
                    ->with(['campaign', 'service', 'operator'])
                    ->first();
             $traffic->callback_received_status =  1;
             $traffic->save();
 
             // find publisher by short_name like
             $publisher = Publisher::where('short_name', 'like', '%' . $channel . '%')->first();
             // Post Back Sent to Publisher url
             $postBackUrl = $publisher->post_back_url;
            //  find 'clickedID' and replace with $clickedID
            $hasClickedId = strpos($postBackUrl, 'clickedID');
            if($hasClickedId){
                $postBackUrl = str_replace('$clickedID', $clickedID, $postBackUrl);
            }

            $postBackUrl = str_replace('$msisdn', $request->msisdn, $postBackUrl);
            $postBackUrl = str_replace('$operator', $operatorName, $postBackUrl);
            $postBackUrl = str_replace('$shortcode', $request->shortcode, $postBackUrl);
            $postBackUrl = str_replace('$shortcode', $request->shortcode, $postBackUrl);
            $postBackUrl = str_replace('$service', $serviceName, $postBackUrl);
            $postBackUrl = str_replace('$tagp', $clickedID, $postBackUrl);

            //$response = Http::get($postBackUrl);
            //dd($postBackUrl);
            //https://api.marvelmanager.com/g/mtgbmbd/mo/?msisdn=$msisdn&country=BD&operator=$operator&moid=$clickid&shortcode=$shortcode&msg=$service&refid=$tagp

            //$request_parm
            // http://b2mp.b2mwap.com/api/postback/bd/blink/$channel/$postback_service/$zoneid?msisdn=$msisdn&opr=BANGLALINK&shortcode=27575&text=sub
            
            // PostBackReceivedLog
            $postBackReceivedLog = new PostBackReceivedLog();
            $postBackReceivedLog->operator_id = $traffic->operator_id;
            $postBackReceivedLog->campaign_id = $traffic->campaign->id;
            $postBackReceivedLog->service_id = $traffic->service_id;
            $postBackReceivedLog->channel = $channel;
            $postBackReceivedLog->clicked_id = $clickedID;
            $postBackReceivedLog->received_at = now();
            $postBackReceivedLog->save();




            //  current date
            $date = Carbon::now()->format('Y-m-d');

            $postBackReceiveCount = PostBackReceivedLog::select()
                ->where('created_at', 'like', '%' . $date . '%')
                ->where('campaign_id', $traffic->campaign->id)
                ->count();
            $postBackSendCount = PostBackSentLog::select()
                ->where('created_at', 'like', '%' . $date . '%')
                ->where('campaign_id', $traffic->campaign->id)
                ->count();
 
            if($postBackSendCount / $postBackReceiveCount  <= (float)$traffic->campaign->ratio){
                // PostBackSentLog
                $postBackSentLog = new PostBackSentLog();
                $postBackSentLog->operator_id = $traffic->operator_id;
                $postBackSentLog->service_id = $traffic->service_id;
                $postBackSentLog->campaign_id = $traffic->campaign->id;
                $postBackSentLog->channel = $channel;
                $postBackSentLog->clicked_id = $clickedID;
                $postBackSentLog->others = json_encode($request->all());
                $postBackSentLog->sent_at = now();
                // send
                $postBackSentLog->post_back_url = $postBackUrl;
                $response = Http::get($postBackUrl);
                if($response){
                    $postBackSentLog->response = $response->body();
                    $traffic->callback_sent_status = 1;
                }else{
                    $traffic->callback_sent_status = 0;
                }
                $traffic->save();
                $postBackSentLog->save();
            }


            // end

 
             $postBackData = [
                 'operator' => [
                     'id' => $traffic->operator_id,
                     'name' => $traffic->operator->name,
                 ],
                 'service' => [
                     'id' => $traffic->service_id,
                     'name' => $traffic->service->name,
                 ],
                 'channel' => $channel,
                 'clickedId' => $clickedID,
                 'others' => $request->all(),
                 'received_at' => now(),
                 'sent_at' => now(),
             ];

             
 
             return $this->respondWithSuccess('Post back received successfully.', $postBackData);
         } catch (\Throwable $e) {
             return response()->json([
                 'status'   => false,
                 'errors'  => true,
                 'message'  => 'Post back failed to receive.',
                 'data'     => $e->getMessage()
             ], 203);
         }
     }
    // sendLogs
    public function sendLogs()
    {
        // ajax request
        if (request()->ajax()) {
            $model = PostBackSentLog::query()->with(['operator', 'service'])
                ->orderBy('id', 'desc');
            return DataTables::eloquent($model)
                ->addColumn('service_name', function (PostBackSentLog $log) {
                    return $log->service->name;
                })
                ->addColumn('channel', function (PostBackSentLog $log) {
                    return $log->channel;
                })
                ->addColumn('operator_name', function (PostBackSentLog $log) {
                    return $log->operator->name;
                })
                ->addColumn('sent_at', function (PostBackSentLog $log) {
                    return date('d-M-Y H:i:s a', strtotime($log->sent_at));
                })
                ->toJson();
        }
        return view('post_back.sent-logs');
    }

    // receivedLogs
    public function receivedLogs()
    {
        // ajax request
        if (request()->ajax()) {
            $model = PostBackReceivedLog::query()->with(['operator', 'service'])
                ->orderBy('id', 'desc');
            return DataTables::eloquent($model)
                ->addColumn('channel', function (PostBackReceivedLog $log) {
                    return $log->channel;
                })
                ->addColumn('service_name', function (PostBackReceivedLog $log) {
                    return $log->service->name;
                })
                ->addColumn('operator_name', function (PostBackReceivedLog $log) {
                    return $log->operator->name;
                })
                ->addColumn('received_at', function (PostBackReceivedLog $log) {
                    return date('d-M-Y H:i:s a', strtotime($log->received_at));
                })
                ->toJson();
        }
        return view('post_back.received-logs');
    }
}
