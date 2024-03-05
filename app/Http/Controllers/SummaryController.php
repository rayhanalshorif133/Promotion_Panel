<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Publisher;
use App\Models\Operator;
use App\Models\Service;
use App\Models\PromotionSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;



class SummaryController extends Controller
{
    public function index(Request $request)
    {
        $publisher_id = $request->publisher_id;
        $operator_id = $request->operator_id;
        $service_id = $request->service_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $publishers = Publisher::all();
        $operators = Operator::all();
        $services = Service::all();

        if($request->start_date != null){ $start_date = $request->start_date; } else { $start_date = date('Y-m-d', strtotime('-1 month')); }   
        if($request->end_date != null){ $end_date = $request->end_date; } else { $end_date = date('Y-m-d'); }

        $promotionSummaries = PromotionSummary::orderBy('operation_date', 'asc')
                ->whereDate('operation_date', '>=', $start_date)
                ->whereDate('operation_date', '<=', $end_date)
                ->when($request->publisher_id, function ($query, $publisher_id) {
                    return $query->where('publisher_id', $publisher_id);
                })
                ->when($request->operator_id, function ($query, $operator_id) {
                    return $query->where('operator_id', $operator_id);
                })
                ->when($request->service_id, function ($query, $service_id) {
                    return $query->where('service_id', $service_id);
                })
                ->get();
                
        return view('summary.index', compact('publishers', 'operators', 'services', 'promotionSummaries',
            'publisher_id', 'operator_id', 'service_id', 'start_date', 'end_date'));
    }
}



