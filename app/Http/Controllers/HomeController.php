<?php

namespace App\Http\Controllers;

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
            return view('dashboard');
        }else{
            return redirect()->route('login');
        }
    }
}
