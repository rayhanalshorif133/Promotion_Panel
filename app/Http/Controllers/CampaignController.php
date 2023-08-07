<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        return view('campaigns.index');
    }
    
    public function reportIndex()
    {
        return view('campaigns.report.index');
    }
}
