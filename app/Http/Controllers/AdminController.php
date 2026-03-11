<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function tenantList()
    {
        $tenants = Tenant::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.tenants', compact('tenants'));
    }

    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Forget current tenant (important for multitenancy)
        if (Tenant::current()) {
            Tenant::forgetCurrent();
        }

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
