<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Operator;
use App\Models\Publisher;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function welcome()
    {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login');
        }
    }

    public function index()
    {
        if(Auth::check()){
            $operators = Operator::all()->count();
            $services  = Service::all()->count();
            $publishers  = Publisher::all()->count();
            $campaigns  = Campaign::all()->count();
            return view('dashboard', compact('operators','services','publishers','campaigns'));
        }else{
            return redirect()->route('login');
        }
    }
}
