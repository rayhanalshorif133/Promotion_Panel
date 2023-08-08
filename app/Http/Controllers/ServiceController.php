<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::select('name', 'type', 'traffic_redirect_url', 'status')
            ->orderBy('id', 'desc')
            ->get();
        return view('service.index', compact('services'));
    }

    public function fetchById($id)
    {
        $service = Service::find($id);
        if ($service) return $this->respondWithSuccess('Successfully fetched Country data', $service);
        else  return $this->respondWithError('Service not found');
    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:services',
            'type' => 'required',
            'traffic_redirect_url' => 'required',
            'status' => 'required'
        ]);

        if (!filter_var($request->traffic_redirect_url, FILTER_VALIDATE_URL)) {
            Session::flash('message', 'Invalid URL');
            Session::flash('type', 'error');
            return redirect()->route('service.index');
        }

        try {
            // store
            $service = new Service();

            $name = str_replace(' ', '', $request->name);
            $service->name = $name;
            $service->type = $request->type;
            $service->traffic_redirect_url = $request->traffic_redirect_url;
            $service->status = $request->status;
            $service->save();

            // redirect
            Session::flash('message', 'Successfully created a new service');
            return redirect()->route('service.index');
        } catch (\Throwable $th) {
            Session::flash('message', 'Failed to create a new service');
            Session::flash('type', 'error');
            return redirect()->route('service.index');
        }
    }

    public function update(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:services,name,' . $request->id,
            'type' => 'required',
            'traffic_redirect_url' => 'required',
            'status' => 'required'
        ]);


        if (!filter_var($request->traffic_redirect_url, FILTER_VALIDATE_URL)) {
            Session::flash('message', 'Invalid URL');
            Session::flash('type', 'error');
            return redirect()->route('service.index');
        }

        try {
            // store
            $service = Service::find($request->id);

            $name = str_replace(' ', '', $request->name);
            $service->name = $name;
            $service->type = $request->type;
            $service->traffic_redirect_url = $request->traffic_redirect_url;
            $service->status = $request->status;
            $service->save();

            // redirect
            Session::flash('message', 'Successfully update this service');
            return redirect()->route('service.index');
        } catch (\Throwable $th) {
            Session::flash('message', 'Failed to update this service');
            Session::flash('type', 'error');
            return redirect()->route('service.index');
        }
    }

    public function destroy($id)
    {
        try {
            $country = Service::find($id);
            $country->delete();
            return $this->respondWithSuccess('Successfully deleted this service');
        } catch (\Throwable $th) {
            return $this->respondWithError('Failed to delete this service');
        }
    }
}
