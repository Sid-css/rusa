<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Allow only users with role = 'admin'.
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized – Admins only.');
        }

        return $next($request);
    }
}
