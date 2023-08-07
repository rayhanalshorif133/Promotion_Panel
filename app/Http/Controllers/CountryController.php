<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        return view('country.index');
    }
}



