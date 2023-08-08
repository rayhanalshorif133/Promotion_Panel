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

        $name = str_replace(' ', '', $request->name);
        $operator->name = $name;
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

    public function destroy($id)
    {
        try {
            $operator = Operator::find($id);
            $operator->delete();
            return $this->respondWithSuccess('Successfully deleted this operator');
        } catch (\Throwable $th) {
            return $this->respondWithError('Failed to delete this operator');
        }
    }
}
