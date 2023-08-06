<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function welcome()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }else{
            return redirect()->route('login');
        }
    }

    public function index()
    {
        if(Auth::check()){
            return view('home');
        }else{
            return redirect()->route('login');
        }
    }
}
