<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\alert;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function storeLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;
        $domain = $request->getHost();
        
        // Admin login
        if ($domain == '127.0.0.1' || $domain == 'localhost') {
            $user = AdminUser::where('email', $email)->first();

            if ($user && Hash::check($password, $user->password)) {
                Auth::guard('admin')->login($user);
                return redirect()->route('admin.dashboard'); 
            }
            return back()->with('error', 'Invalid credentials for central admin');
        }

        // Tenant Login
        $tenant = Tenant::where('domain', $domain)->first();
        if (!$tenant) {
            abort(404, 'Tenant not found');
        }
        $tenant->makeCurrent(); 
     
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user); 
            return redirect()->route('tenant.dashboard');
        }
        return back()->with('error', 'Invalid credentials for tenant');
    }

    public function companyRegister()
    {
        return view('admin.register');
    }
    public function companyStoreRegister(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required',
            'domain'=>'required|unique:tenants',
        ]);

        try {
            $database = 'tenant_' . strtolower(str_replace(' ', '_', $request->name));

            DB::statement("CREATE DATABASE $database");

            $tenant = Tenant::create([
                'name'=>$request->name,
                'domain'=>$request->domain,
                'database'=>$database
            ]);

           
            // Switch to tenant database
            config(['database.connections.tenant.database' => $database]);

             DB::purge('tenant');
            DB::reconnect('tenant');


            // Run migrations for tenant
            Artisan::call('migrate', [
                '--database' => 'tenant',
                '--path' => 'database/migrations/tenant',
                '--force' => true
            ]);

            // Clear permission cache
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();


           Role::on('tenant')->create(['name' => 'owner']);
            Role::on('tenant')->create(['name' => 'manager']);
            Role::on('tenant')->create(['name' => 'employee']);


            // Create owner user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('owner');
            return redirect()->route('login') ->with('success', 'Tenant registered successfully!');

        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $ex->getMessage());
        }
    }
}
