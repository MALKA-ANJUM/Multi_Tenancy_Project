<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    public function tenantDashboard()
    {
        return view('tenant.dashboard');
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
