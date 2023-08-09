<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::select('id','name','short_name','post_back_url','status')
            ->orderBy('id', 'desc')
            ->get();
        return view('publisher.index', compact('publishers'));
    }

    public function fetchById($id)
    {
        $service = Publisher::find($id);
        if ($service) return $this->respondWithSuccess('Successfully fetched Country data', $service);
        else  return $this->respondWithError('Service not found');
    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required',
            'short_name' => 'required|unique:publishers',
            'status' => 'required'
        ]);


        try {
            // store
            $publisher = new Publisher();
            $publisher->name = $request->name;
            $shortName = str_replace(' ', '', $request->short_name);
            $publisher->short_name = $shortName;
            $publisher->status = $request->status;
            $publisher->save();

            // redirect
            Session::flash('message', 'Successfully created a new publisher');
            return redirect()->route('publisher.index');
        } catch (\Throwable $th) {
            Session::flash('message', 'Failed to create a new publisher');
            Session::flash('type', 'error');
            return redirect()->route('publisher.index');
        }
    }

    public function update(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required',
            'short_name' => 'required|unique:publishers,short_name,' . $request->id,
            'status' => 'required'
        ]);


        try {
            // store
            $publisher = Publisher::find($request->id);
            $publisher->name = $request->name;
            $shortName = str_replace(' ', '', $request->short_name);
            $publisher->short_name = $shortName;
            $publisher->status = $request->status;
            $publisher->save();
            Session::flash('message', 'Successfully update this publisher');
            return redirect()->route('publisher.index');
        } catch (\Throwable $th) {
            Session::flash('message', 'Failed to update this publisher');
            Session::flash('type', 'error');
            return redirect()->route('publisher.index');
        }
    }

    public function destroy($id)
    {
        try {
            $publisher = Publisher::find($id);
            $publisher->delete();
            return $this->respondWithSuccess('Successfully deleted this publisher');
        } catch (\Throwable $th) {
            return $this->respondWithError('Failed to delete this publisher');
        }
    }
}
