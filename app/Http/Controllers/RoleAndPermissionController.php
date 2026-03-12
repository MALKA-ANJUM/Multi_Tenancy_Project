<?php

namespace App\Http\Controllers;

use App\Models\TenantPermission;
use App\Models\TenantRole;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;

class RoleAndPermissionController extends Controller
{
    public function userList(Request $request)
    {
        $users = User::paginate(10);
        return view('tenant.user.list', compact('users'));
    }
    public function addUserForm(Request $request)
    {
        $roles = Role::get();;
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
            $role = Role::where('name', $request->role)->first();
            $newUser->assignRole($role);
            return to_route('tenant.user-list')->with('User Added Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editUser(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $roles = Role::get();
        return view('tenant.user.edit', compact('user', 'roles'));
    }
    public function updateUser(Request $request)
    {
        $request->validate([
            'email' => 'unique:tenant.users,email,' . $request->id,
        ]);
        try {
            $existingUser = User::where('id', $request->id)->first();
            $existingUser->name =  $request->name;
            $existingUser->email =  $request->email;
            $existingUser->save();
            $role = Role::where('name', $request->role)->first();
            $existingUser->syncRoles([$role->name]);
            return to_route('tenant.user-list')->with('success', 'User Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            $existingUser = User::where('id', $request->id)->delete();
            return to_route('tenant.user-list')->with('success', 'User Deleted Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Permissions
    public function addPermissionForm()
    {
        return view('tenant.permission.add-permission');
    }
    public function addPermission(Request $request)
    {
        Permission::create([
            'name' => 'tenant' . '.' . $request->permission,
            'guard_name' => 'web'
        ]);
        return redirect()->back()->with('success', 'Permission Added Successfully');
    }
    public function roleList()
    {
        $rolesDetails = TenantRole::paginate(10);
        return view('tenant.role.list', compact('rolesDetails'));
    }
    public function addRoleForm(Request $request)
    {
        return view('tenant.role.add_role_form');
    }
   
    public function addRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required|unique:roles,name',
        ]);
        Role::create([
            'name' => $request->role_name,
            'guard_name' => 'web',
            'created_by' => auth()->user()->id,
        ]);
        return to_route('tenant.roles')->with('success', 'Role Added Successfully');
    }

    public function assignPermissionForm(Request $request)
    {

        // get the Route names and add to permisions table
        $routes = Route::getRoutes();


        foreach ($routes as $route) {
            $routeName = $route->getName();
            $action = $route->getAction();
            // Get the prefix from the route action

            if ($routeName) {
                TenantPermission::firstOrCreate([
                    'name' => $routeName,
                    'guard_name' => 'web',
                ]);
            }
        }

        //Assign All Permissions To Admin
        $Admin = TenantRole::findByName('Owner');
        $Admin->givePermissionTo(TenantPermission::all());

        $role = TenantRole::findByName($request->role_name);
        $roleName = $request->role_name;
        $assignedPermissions = $role->permissions->pluck('id')->toArray();
        // $permissions = TenantPermission::orderBy('id', 'ASC')->get();
        $permissions = TenantPermission::all()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });
        return view('tenant.permission.assign-permissions', compact('permissions', 'assignedPermissions', 'roleName'));
    }

    function assignPermissions(Request $request)
    {
        $role = TenantRole::findByName($request->role_name);
        $role->syncPermissions($request->permissions);
        return redirect()->back();
    }
}
