<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CredentialController extends Controller
{
    // index
    public function index()
    {
        $credentials = Credential::all();
        return view('credentials.index', compact('credentials'));
    } 
    
    public function create()
    {
        return view('credentials.create');
    }

   

    // store
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'password' => 'required'
        ]);

        // store
        $credential = new Credential();
        $credential->added_by = auth()->user()->id;
        $credential->title = $request->title;
        $credential->details = $request->details;
        $credential->password = $request->password;

        // redirect
        Session::flash('message', 'Successfully created a new operator');
        return redirect()->route('operator.index');
        
    }

    // view

    // edit

    // update

    // destroy
}
