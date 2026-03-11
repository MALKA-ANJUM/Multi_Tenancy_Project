<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
    public function userList(Request $request)
    {
        $users = User::on('tenant')->paginate(10);
        return view('tenant.user.list', compact('users'));
    }
    public function addUserForm(Request $request)
    {
        $roles = Role::on('tenant')->get();;
        return view('tenant.user.add', compact('roles'));
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'email' => 'unique:tenant.users,email',
            'password' => 'min:8',
        ]);

        try {
            $newUser = new User();
            $newUser->name =  $request->name;
            $newUser->email =  $request->email;
            $newUser->password =  Hash::make($request->password);
            $newUser->save();
            $role = Role::on('tenant')->where('name', $request->role)->first();
            $newUser->assignRole($role);
            return to_route('tenant.user-list')->with('User Added Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editUser(Request $request)
    {
        $user = User::on('tenant')->where('id', $request->id)->first();
        $roles = Role::on('tenant')->get();
        return view('tenant.user.edit', compact('user', 'roles'));
    }
    public function updateUser(Request $request)
    {
        $request->validate([
            'email' => 'unique:tenant.users,email,' . $request->id,
        ]);
        try {
            $existingUser = User::on('tenant')->where('id', $request->id)->first();
            $existingUser->name =  $request->name;
            $existingUser->email =  $request->email;
            $existingUser->save();
           $role = Role::on('tenant')->where('name', $request->role)->first();
            $existingUser->syncRoles([$role->name]);
            return to_route('tenant.user-list')->with('success', 'User Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            $existingUser = User::on('tenant')->where('id', $request->id)->delete();
            return to_route('tenant.user-list')->with('success', 'User Deleted Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
