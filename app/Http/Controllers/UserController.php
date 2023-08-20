<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function index(){
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::select()
            ->where('id', $id)
            ->with('roles','permissions')
            ->first();
        $roles = Role::all();
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $permission->checked = $user->hasPermissionTo($permission->name);
        }
        return view('user.edit', compact('user', 'roles', 'permissions'));
    }

    // update
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'email|required|unique:users,email,' . $id . '|max:50',
            'role' => 'required',
            'permissions' => 'required'
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

        $user->syncRoles($request->role);
        $user->syncPermissions($request->permissions);

        Session::flash('message', 'User updated successfully');
        return redirect()->back();
    }
}


