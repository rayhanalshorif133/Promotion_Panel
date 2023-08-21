<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\PostBackReceivedLog;
use App\Models\PostBackSentLog;
use App\Models\Publisher;
use App\Models\Service;
use App\Models\Traffic;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TrafficController extends Controller
{

    public function index()
    {
        // ajax request
        if (request()->ajax()) {
            $model = Traffic::query()->with('campaign', 'service', 'operator')->orderBy('id', 'desc');
            return DataTables::eloquent($model)
                ->addColumn('DT_RowIndex', function () {
                    static $index = 1;
                    return $index++;
                })
                ->addColumn('campaign_name', function (Traffic $traffic) {
                    return $traffic->campaign->name;
                })
                ->addColumn('service_name', function (Traffic $traffic) {
                    return $traffic->service->name;
                })
                ->addColumn('operator_name', function (Traffic $traffic) {
                    return $traffic->operator->name;
                })
                ->addColumn('action', function (Traffic $traffic) {
                    return '';
                })
                ->toJson();
        }
        return view('traffic.index');
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

        try{

            $traffic = Traffic::select()->where('clicked_id', $clickedID)
            ->with(['campaign', 'service', 'operator'])    
            ->first();
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


            // PostBackSentLog
            $postBackSentLog = new PostBackSentLog();
            $postBackSentLog->operator_id = $traffic->operator_id;
            $postBackSentLog->service_id = $traffic->service_id;
            $postBackSentLog->channel = $channel;
            $postBackSentLog->clicked_id = $clickedID;
            $postBackSentLog->others = json_encode($request->all());
            $postBackSentLog->sent_at = now();
            $postBackSentLog->save();

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

        }catch (\Throwable $e){
            return response()->json([
                'status'   => false,
                'errors'  => true,
                'message'  => 'Post back failed to receive.',
            ], 203);
        }
    }


    public function destroy($id)
    {
        $traffic = Traffic::find($id);
        if(!$traffic){
            return $this->respondWithError('Traffic not found.');
        }
        $traffic->delete();
        return $this->respondWithSuccess('Traffic deleted successfully.');
    }   
}
