<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    // update
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'email|required|unique:users,email,' . $id . '|max:50',
        ]);

        $user = User::find($id);

        
        if($request->password != null){
            $this->validate($request, [
                'password' => 'confirmed|min:6|max:50',
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email  = $request->email;
        $user->save();
        Session::flash('message', 'User updated successfully');
        return redirect()->back();
    }
}


