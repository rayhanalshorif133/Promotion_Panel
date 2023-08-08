<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::select('id', 'name', 'status')->orderBy('id', 'desc')->get();
        return view('country.index', compact('countries'));
    }

    public function fetchById($id)
    {
        $country = Country::find($id);
        if ($country) return $this->respondWithSuccess('Successfully fetched Country data', $country);
        else  return $this->respondWithError('Country not found');
    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:operators',
            'status' => 'required'
        ]);

        // store
        $country = new Country();

        $name = str_replace(' ', '', $request->name);
        $country->name = $name;
        $country->status = $request->status;
        $country->save();

        // redirect
        Session::flash('message', 'Successfully created a new country');
        return redirect()->route('country.index');
    }

    public function update(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:countries,name,' . $request->id,
            'status' => 'required'
        ]);

        // store
        $country = Country::find($request->id);
        $country->name = $request->name;
        $country->status = $request->status;
        $country->save();

        // redirect
        Session::flash('message', 'Successfully updated this country');
        return redirect()->route('country.index');
    }

    public function destroy($id)
    {
        try {
            $country = Country::find($id);
            $country->delete();
            return $this->respondWithSuccess('Successfully deleted this country');
        } catch (\Throwable $th) {
            return $this->respondWithError('Failed to delete this country');
        }
    }
}



