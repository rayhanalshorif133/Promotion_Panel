<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;

class CredentialController extends Controller
{
    // index
    public function index()
    {
        $credentials = Credential::select()
            ->where('added_by', auth()->user()->id)
            ->get();
        return view('credentials.index', compact('credentials'));
    }

    public function create()
    {
        return view('credentials.create');
    }



    // store
    public function store(Request $request)
    {


        if ($request->files->get('file') != null) {
            Session::flash('message', 'File not supported');
            return redirect()->back();
        }
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
        $credential->password = Crypt::encryptString($request->password);
        $credential->save();

        // $decrypted = Crypt::decryptString($encrypted);
        Session::flash('message', 'Successfully created a new operator');
        return redirect()->route('credentials.index');
    }

    // getPassword
    public function getPassword($id)
    {
        $credential = Credential::find($id);
        $decrypted = Crypt::decryptString($credential->password);
        return $this->respondWithSuccess('Successfully retrieved password', $decrypted);
    }

    // view
    public function show($id)
    {
        $credential = Credential::find($id);
        $decrypted = Crypt::decryptString($credential->password);
        return view('credentials.view', compact('credential', 'decrypted'));
    }

    // edit
    public function edit($id)
    {
        $credential = Credential::find($id);
        $decrypted = Crypt::decryptString($credential->password);
        return view('credentials.edit', compact('credential', 'decrypted'));
    }

    // update
    public function update(Request $request,$id)
    {


        if ($request->files->get('file') != null) {
            Session::flash('message', 'File not supported');
            return redirect()->back();
        }
        // validate
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'password' => 'required'
        ]);

        // store
        $credential = Credential::find($id);
        $credential->added_by = auth()->user()->id;
        $credential->title = $request->title;
        $credential->details = $request->details;
        $credential->password = Crypt::encryptString($request->password);
        $credential->save();
        Session::flash('message', 'Successfully updated credential');
        return redirect()->route('credentials.index');
    }

    // destroy
    public function destroy($id)
    {
        try {
            $credential = Credential::find($id);
            $credential->delete();
            return $this->respondWithSuccess('Successfully deleted credential');
        } catch (\Throwable $th) {
            return $this->respondWithError('Error deleting credential');
        }
    }
}
