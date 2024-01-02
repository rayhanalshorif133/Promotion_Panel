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
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CampaignController extends Controller
{
    public function index()
    {
        // ajax request
        if (request()->ajax()) {
            $model = Campaign::query()->with('publisher')->orderBy('id', 'desc');
            return DataTables::eloquent($model)
                ->addColumn('DT_RowIndex', function () {
                    static $index = 1;
                    return $index++;
                })
                ->addColumn('ratio', function (Campaign $campaign) {
                    return $campaign->ratio;
                })
                ->addColumn('status', function (Campaign $campaign) {
                    return $campaign->status;
                })
                ->addColumn('action', function (Campaign $user) {
                    return '';
                })
                ->toJson();
        }
        return view('campaigns.index');
    }


    public function create()
    {
        $publishers = Publisher::select('id', 'name', 'short_name')->get();
        $operators = Operator::select('id', 'name')->get();
        $services = Service::select('id', 'name')->get();
        return view('campaigns.create', compact('publishers', 'operators', 'services'));
    }



    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:campaigns',
            'publisher_id' => 'required',
            'operatorIds' => 'required',
            'serviceIds' => 'required',
            'ratio' => 'required',
            'status' => 'required'
        ]);


        if (count($request->operatorIds) != count($request->serviceIds)) {
            Session::flash('message', 'Operator and Service count does not match');
            Session::flash('type', 'error');
            return redirect()->back();
        }


        try {
            // store
            $campaign = new Campaign();
            $campaign->name = $request->name;
            $campaign->publisher_id = $request->publisher_id;
            $campaign->ratio = $request->ratio;
            $campaign->status = $request->status;
            $campaign->save();

            for ($index = 0; $index < count($request->operatorIds); $index++) {

                $findCampaignDetail = CampaignDetail::where('campaign_id', $campaign->id)
                    ->where('operator_id', $request->operatorIds[$index])
                    ->where('service_id', $request->serviceIds[$index])
                    ->first();

                if ($findCampaignDetail) {
                    $campaign->delete();
                    Session::flash('message', 'Operator and Service already exists');
                    Session::flash('type', 'error');
                    return redirect()->back();
                }

                $campaignDetail = new CampaignDetail();
                $campaignDetail->campaign_id = $campaign->id;
                $campaignDetail->operator_id = $request->operatorIds[$index];
                $campaignDetail->service_id = $request->serviceIds[$index];
                $findOperator = Operator::find($campaignDetail->operator_id);
                if ($findOperator) {
                    // https or http
                    $currentDomain = $_SERVER['SERVER_PROTOCOL'];
                    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
                    // domain
                    $currentDomain = $_SERVER['SERVER_NAME'];
                    // url
                    $url = $protocol . $currentDomain . "/traffic/" . $campaign->id . "/" . $campaignDetail->service_id . "/" . $findOperator->name .
                        "/{clickedID}";

                    $campaignDetail->url = $url;
                }
                $campaignDetail->save();
            }
            Session::flash('message', 'Successfully created a new campaign');
            return redirect()->route('campaign.index');
        } catch (\Throwable $th) {
            Session::flash('message', $th->getMessage());
            Session::flash('type', 'error');
            return redirect()->route('campaign.index');
        }
    }




    public function show($id)
    {

        $campaign = Campaign::select()
            ->where('id', $id)
            ->with('publisher', 'campaignDetails')
            ->first();
        if ($campaign) {
            return view('campaigns.show', compact('campaign'));
        } else {
            Session::flash('message', 'No campaign found');
            Session::flash('type', 'error');
            return redirect()->route('campaign.index');
        }
    }

    public function edit($id)
    {

        $campaign = Campaign::select()
            ->where('id', $id)
            ->with('publisher', 'campaignDetails')
            ->first();
        $publishers = Publisher::select('id', 'name', 'short_name')->get();
        $operators = Operator::select('id', 'name')->get();
        $services = Service::select('id', 'name')->get();
        return view('campaigns.edit', compact('campaign', 'publishers', 'operators', 'services'));
    }



    public function update(Request $request)
    {


        // validate
        $request->validate([
            'name' => 'required|unique:campaigns,name,' . $request->id,
            'publisher_id' => 'required',
            'operatorIds' => 'required',
            'serviceIds' => 'required',
            'ratio' => 'required',
            'status' => 'required'
        ]);


        try {
            // store
            $campaign = Campaign::find($request->id);
            $campaign->name = $request->name;
            $campaign->publisher_id = $request->publisher_id;
            $campaign->ratio = $request->ratio;
            $campaign->status = $request->status;
            $campaign->save();
            $campaignDetail = CampaignDetail::where('campaign_id', $request->id)
                ->get();
            if ($campaignDetail) {
                foreach ($campaignDetail as $key => $value) {
                    $value->delete();
                }
            }
            for ($index = 0; $index < count($request->operatorIds); $index++) {

                $campaignDetail = new CampaignDetail();
                $campaignDetail->campaign_id = $campaign->id;
                $campaignDetail->operator_id = $request->operatorIds[$index];
                $campaignDetail->service_id = $request->serviceIds[$index];
                $findOperator = Operator::find($campaignDetail->operator_id);
                if ($findOperator) {
                    // https or http
                    $currentDomain = $_SERVER['SERVER_PROTOCOL'];
                    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
                    // domain
                    $currentDomain = $_SERVER['SERVER_NAME'];
                    // url
                    $url = $protocol . $currentDomain . "/traffic/" . $campaign->id . "/" . $campaignDetail->service_id . "/" . $findOperator->name .
                        "/{clickedID}";

                    $campaignDetail->url = $url;
                }
                $campaignDetail->save();
            }
            Session::flash('message', 'Successfully created a new campaign');
            return redirect()->route('campaign.index');
        } catch (\Throwable $th) {
            Session::flash('message', $th->getMessage());
            Session::flash('type', 'error');
            return redirect()->route('campaign.index');
        }
    }

    public function report()
    {
        $campaigns = Campaign::all();
        $operators = Operator::all();
        return view('campaigns.report', compact('campaigns', 'operators'));
    }
    public function campaignReportData($campaign_id, $start_date, $end_date = null)
    {
        // ajax request
        if (request()->ajax()) {
            // count of days
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
            $days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
            $days = $days + 1;
            $data = [];

            for ($index = 0; $index < $days; $index++) {
                $date = date('Y-m-d', strtotime($start_date . ' + ' . $index . ' days'));
                $services = $this->getServices($campaign_id,$date);
                $data[$index]['date'] = $date;
                $data[$index]['services'] = $services;
                $data[$index]['traffic_received'] = $this->countOfTrafficReceived($services,$campaign_id,$date);
                $data[$index]['post_back_received'] = $this->countOfPostBackReceived($services,$campaign_id,$date);
                $data[$index]['post_back_sent'] = $this->countOfPostBackSent($services,$campaign_id,$date);
            }

            return DataTables::collection($data)
                ->addColumn('DT_RowIndex', function () {
                    static $index = 1;
                    return $index++;
                })
                ->addColumn('traffic_received', function ($data) {
                    return $data['traffic_received'];
                })
                ->addColumn('post_back_received', function ($data) {
                    return $data['post_back_received'];
                })
                ->addColumn('post_back_sent', function ($data) {
                    return $data['post_back_sent'];
                })
                ->addColumn('service', function ($data) {
                    return $data['services'];
                })
                ->addColumn('action', function ($data) {
                    return '';
                })
                ->toJson();
        }
    }

    public function campaignReport($campaign_id, $start_date, $end_date = null){
        $operators = Operator::select('name')->get();

        $campaigns = "";

        if($campaign_id == 'all'){
            $campaigns = Campaign::select('id','name')->get();
        }else{
            $campaigns = Campaign::select('id','name')->where('id',$campaign_id)->get();
        }

        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
        $days = $days + 1;
        $report = [];

        for ($index = 0; $index < $days; $index++) {
            $date = date('Y-m-d', strtotime($start_date . ' + ' . $index . ' days'));
            $services = $this->getServices($campaign_id,$date);
            $report[$index]['date'] = $date;
            $report[$index]['campaigns'] = $campaigns;
            $report[$index]['services'] = $services;
            $report[$index]['traffic_received'] = $this->countOfTrafficReceived($services,$campaign_id,$date);
            $report[$index]['post_back_received'] = $this->countOfPostBackReceived($services,$campaign_id,$date);
            $report[$index]['post_back_sent'] = $this->countOfPostBackSent($services,$campaign_id,$date);;
        }


        // send data
        $data = [
            'reports' => $report,
            'operators' => $operators,
        ];
        return $this->respondWithSuccess("Successfully fetch campaing report",$data);
    }



    public function countOfTrafficReceived($services, $campaign_id,$date)
    {
        // $services
        $operators = Operator::all();
        $trafficReceived = [];
        foreach ($services as $value) {
            $service_id = $value['id'];
            foreach ($operators as $operator) {

                if($campaign_id == 'all'){
                    $operatorIds = Traffic::select('operator_id')
                    ->where('service_id', $service_id)
                    ->where('received_at', 'like', '%' . $date . '%')
                    ->where('operator_id', $operator->id)
                    ->with('operator')
                    ->get();
                }else{
                    $operatorIds = Traffic::select('operator_id')
                    ->where('campaign_id', $campaign_id)
                    ->where('service_id', $service_id)
                    ->where('received_at', 'like', '%' . $date . '%')
                    ->where('operator_id', $operator->id)
                    ->with('operator')
                    ->get();
                }
                array_push($trafficReceived, [
                    'operator_name' => $operator->name,
                    'count' => count($operatorIds)
                ]);
            }

        }
        return $trafficReceived;
    }

    protected function countOfTrafficReceivedByService($service_id,$campaign_id,$date){
        if($campaign_id == 'all'){
            $count = Traffic::where('service_id', $service_id)
                ->where('received_at', 'like', '%' . $date . '%')
                ->count();
        }else{
            $count = Traffic::where('campaign_id', $campaign_id)
                ->where('service_id', $service_id)
                ->where('received_at', 'like', '%' . $date . '%')
                ->count();
        }
        return $count;
    }

    public function getServices($campaign_id,$date)
    {
        $serviceNameIds = [];
        if($campaign_id == 'all'){
            $services = Traffic::select("service_id")
            ->where('received_at', 'like', '%' . $date . '%')
            ->with('service')
            ->get()
            ->unique('service_id');
        }else{
            $services = Traffic::select("service_id")
                ->where('campaign_id', $campaign_id)
                ->where('received_at', 'like', '%' . $date . '%')
                ->with('service')
                ->get()
                ->unique('service_id');
        }
        foreach ($services as $key => $value) {
            array_push($serviceNameIds, [
                'id' => $value->service->id,
                'name' => $value->service->name,
                'count' => $this->countOfTrafficReceivedByService($value->service->id,$campaign_id,$date)
            ]);
        }
        return $serviceNameIds;
    }

    public function countOfPostBackReceived($services,$campaign_id,$date)
    {
        $operators = Operator::all();
        $postBackTrafficReceived = [];
        foreach ($services as $value) {
            $service_id = $value['id'];
            foreach ($operators as $operator) {
                if($campaign_id == 'all'){
                    $count = PostBackReceivedLog::where('received_at', 'like', '%' . $date . '%')
                    ->where('operator_id', $operator->id)
                    ->where('service_id', $service_id)
                    ->count();
                }else{
                    $count = PostBackReceivedLog::where('received_at', 'like', '%' . $date . '%')
                        ->where('operator_id', $operator->id)
                        ->where('service_id', $service_id)
                        ->where('campaign_id', $campaign_id)
                        ->count();
                }
                array_push($postBackTrafficReceived, [
                    'operator_name' => $operator->name,
                    'service_name' => $value['name'],
                    'count' => $count
                ]);
            }

        }
        return $postBackTrafficReceived;
    }
    public function countOfPostBackSent($services,$campaign_id,$date)
    {
        $operators = Operator::all();
        $postBackTrafficSent = [];
        foreach ($services as $value) {
            $service_id = $value['id'];
            foreach ($operators as $operator) {
                if($campaign_id == 'all'){
                    $count = PostBackSentLog::where('sent_at', 'like', '%' . $date . '%')
                    ->where('operator_id', $operator->id)
                    ->where('service_id', $service_id)
                    ->count();
                }else{
                    $count = PostBackSentLog::where('sent_at', 'like', '%' . $date . '%')
                        ->where('operator_id', $operator->id)
                        ->where('service_id', $service_id)
                        ->where('campaign_id', $campaign_id)
                        ->count();
                }
                array_push($postBackTrafficSent, [
                    'operator_name' => $operator->name,
                    'service_name' => $value['name'],
                    'count' => $count
                ]);
            }

        }
        return $postBackTrafficSent;
    }


    public function destroy($id)
    {
        try {
            $campaign = Campaign::find($id);
            $campaign->delete();
            return $this->respondWithSuccess('Successfully deleted this campaign');
        } catch (\Throwable $th) {
            return $this->respondWithError('Failed to delete this campaign');
        }
    }
}
