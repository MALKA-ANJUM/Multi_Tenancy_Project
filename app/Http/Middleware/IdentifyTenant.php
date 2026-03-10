<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class IdentifyTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domain = $request->getHost();
        if ($domain === '127.0.0.1' || $domain === 'localhost') {
            return $next($request);
        }
        $tenant = Tenant::where('domain', $domain)->first();

        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        // Switch database
        config(['database.connections.tenant.database' => $tenant->database]);

        DB::purge('tenant');
        DB::reconnect('tenant');
        return $next($request);
    }
}
