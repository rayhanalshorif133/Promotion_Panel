<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignDetail;
use App\Models\Operator;
use App\Models\Publisher;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CampaignController extends Controller
{
    public function index()
    {


        $campaigns = Campaign::select()
            ->with('publisher', 'campaignDetail')
            ->get();
        return view('campaigns.index', compact('campaigns'));
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
            'operator_id' => 'required',
            'service_id' => 'required',
            'ratio' => 'required',
            'status' => 'required'
        ]);


        try {
            // store
            $campaign = new Campaign();
            $campaign->name = $request->name;
            $campaign->publisher_id = $request->publisher_id;
            $campaign->save();

            $findOperator = Operator::find($request->operator_id);
            $campaignDetail = new CampaignDetail();
            $campaignDetail->campaign_id = $campaign->id;
            $campaignDetail->operator_id = $request->operator_id;
            $campaignDetail->service_id = $request->service_id;
            $campaignDetail->ratio = $request->ratio;
            if ($findOperator) {
                // https or http
                $currentDomain = $_SERVER['SERVER_PROTOCOL'];
                $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
                // domain
                $currentDomain = $_SERVER['SERVER_NAME'];
                // url
                $url = $protocol . $currentDomain . "/traffic/" . $campaign->id . "/" . $request->service_id . "/" . $findOperator->name .
                    "/{clickedID}/";

                $campaignDetail->url = $url;
            }
            $campaignDetail->status = $request->status;
            $campaignDetail->save();
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
            ->with('publisher', 'campaignDetail', 'campaignDetail.operator', 'campaignDetail.service')
            ->first();
        return view('campaigns.show', compact('campaign'));
    }

    public function edit($id)
    {

        $campaign = Campaign::select()
            ->where('id', $id)
            ->with('publisher', 'campaignDetail', 'campaignDetail.operator', 'campaignDetail.service')
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
            'operator_id' => 'required',
            'service_id' => 'required',
            'ratio' => 'required',
            'status' => 'required'
        ]);


        try {
            // store
            $campaign = Campaign::find($request->id);
            $campaign->name = $request->name;
            $campaign->publisher_id = $request->publisher_id;
            $campaign->save();

            $findOperator = Operator::find($request->operator_id);
            $campaignDetail = CampaignDetail::where('campaign_id', $campaign->id)->first();
            $campaignDetail->campaign_id = $campaign->id;
            $campaignDetail->operator_id = $request->operator_id;
            $campaignDetail->service_id = $request->service_id;
            $campaignDetail->ratio = $request->ratio;
            $campaignDetail->url = $request->url;
            $campaignDetail->status = $request->status;
            $campaignDetail->save();
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
    // DataTables $dataTables
    // campaign_id, start_date, end_date, operator
    public function campaignReportData($campaign_id,$operator, $start_date, $end_date = null)
    {

        // count of days 
        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        $days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
        $days = $days + 1;
        $data = [];
        $data['campaign_id'] = $campaign_id;
        $data['operator'] = $operator;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['days'] = $days;
        return $this->respondWithSuccess('Successfully fetch campaign report\'s data', $data);
        // $model = Campaign::query();
        // return $dataTables->eloquent($model)
        //     ->addColumn('action', function ($row) {
        //         $btn = '<a href="' . route('campaign.show', $row->id) . '" class="btn btn-primary btn-sm">View</a>';
        //         return $btn;
        //     })
        //     ->rawColumns(['action'])
        //     ->make(true);
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
