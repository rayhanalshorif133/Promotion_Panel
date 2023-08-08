<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        $operators = Operator::select('id', 'name', 'status')->orderBy('id', 'desc')->get();
        return view('operator.index', compact('operators'));
    }

    public function store(Request $request){
        // validate
        $request->validate([
            'name' => 'required|unique:operators',
            'status' => 'required'
        ]);

        // store
        $operator = new Operator();
        $operator->name = $request->name;
        $operator->status = $request->status;
        $operator->save();

        // redirect
        return redirect()->route('operator.index');
    }

    public function update(Request $request){
        // validate
        $request->validate([
            'name' => 'required|unique:operators,name,'.$request->id,
            'status' => 'required'
        ]);

        // store
        $operator = Operator::find($request->id);
        $operator->name = $request->name;
        $operator->status = $request->status;
        $operator->save();

        // redirect
        return redirect()->route('operator.index');
    }

    public function destroy(Request $request){
        // find
        $operator = Operator::find($request->id);

        // delete
        $operator->delete();

        // redirect
        return redirect()->route('operator.index');
    }
}
