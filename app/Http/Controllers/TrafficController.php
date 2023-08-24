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
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

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
                ->addColumn('post_back_received', function (Traffic $traffic) {
                    return $traffic->callback_received_status == 1 ? "success" : "failed";
                })
                ->addColumn('post_back_sent', function (Traffic $traffic) {
                    return $traffic->callback_sent_status == 1 ? "success" : "failed";
                })
                ->addColumn('action', function (Traffic $traffic) {
                    return '';
                })
                ->toJson();
        }
        return view('traffic.index');
    }

    public function fetchById($id)
    {
        $traffic = Traffic::with(['campaign', 'service', 'operator'])->find($id);
        $traffic->others = json_decode($traffic->others);

        if (!$traffic) {
            return $this->respondWithError('Traffic not found.');
        }
        return $this->respondWithSuccess('Traffic found.', $traffic);
    }

    public function redirect($campaignId, $serviceId, $operatorName,  $clickedID, Request $request)
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

        if ($clickedID == null) {
            return $this->respondWithError('Please provide clickedID.', $data);
        }

        $operator = Operator::where('name', $operatorName)->first();
        $service = Service::find($serviceId);

        $traffic = new Traffic();
        $traffic->campaign_id = $campaignId;
        $traffic->service_id = $serviceId;
        $traffic->operator_id = $operator ? $operator->id : null;
        $traffic->clicked_id = $clickedID;
        $traffic->others = json_encode($request->all());
        $traffic->received_at = now();
        $traffic->callback_received_status =  0;
        $traffic->callback_sent_status = 0;
        $traffic->save();
        return redirect($service->traffic_redirect_url);
    }

   


    public function destroy($id)
    {
        $traffic = Traffic::find($id);
        if (!$traffic) {
            return $this->respondWithError('Traffic not found.');
        }
        $traffic->delete();
        return $this->respondWithSuccess('Traffic deleted successfully.');
    }

    
}
