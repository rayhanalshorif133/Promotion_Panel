<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponsiveTableController extends Controller
{
    // table
    public function index()
    {
        return view('responsive-table');
    }
}
