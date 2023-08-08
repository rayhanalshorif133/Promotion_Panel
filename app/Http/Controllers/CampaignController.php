<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::select()
            ->with('publisher')
            ->get();
        return view('campaigns.index', compact('campaigns'));
    }
    
    public function create()
    {
        $campaigns = Campaign::select()
            ->with('publisher')
            ->get();
        return view('campaigns.create', compact('campaigns'));
    }
    
    public function reportIndex()
    {
        return view('campaigns.report.index');
    }
}
