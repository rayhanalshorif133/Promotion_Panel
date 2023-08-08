<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OperatorController extends Controller
{
    public function index()
    {
        $operators = Operator::select('id', 'name', 'status')->orderBy('id', 'desc')->get();
        return view('operator.index', compact('operators'));
    }

    public function fetchById($id)
    {
        $operator = Operator::find($id);
        if ($operator) return $this->respondWithSuccess('Successfully fetched operator data', $operator);
        else  return $this->respondWithError('Operator not found');
    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:operators',
            'status' => 'required'
        ]);

        // store
        $operator = new Operator();

        // $request->name remove space
        

        $operator->name = $request->name;
        $operator->status = $request->status;
        $operator->save();

        // redirect
        Session::flash('message', 'Successfully created a new operator');
        return redirect()->route('operator.index');
    }

    public function update(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required|unique:operators,name,' . $request->id,
            'status' => 'required'
        ]);

        // store
        $operator = Operator::find($request->id);
        $operator->name = $request->name;
        $operator->status = $request->status;
        $operator->save();

        // redirect
        Session::flash('message', 'Successfully updated this operator');
        return redirect()->route('operator.index');
    }

    public function destroy(Request $request)
    {
        // find
        $operator = Operator::find($request->id);

        // delete
        $operator->delete();

        // redirect
        Session::flash('message', 'Successfully deleted this operator');
        return redirect()->route('operator.index');
    }
}
