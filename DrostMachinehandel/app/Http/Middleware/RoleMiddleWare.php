<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        Log::emergency("UserRole", [
            "Admin" => $request->user()->hasRole("Admin"),
            "Dealer" => $request->user()->hasRole("Dealer"),
        ]);

        if (!$request->user()->hasRole($role)) {
            return redirect()->route("404");
        }

        return $next($request);
    }
}
