<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
{
    if (!auth()->check()) {
        abort(403, 'Unauthorized');
    }

    // ✅ Prevent NULL or missing column issues
    if (empty(auth()->user()->is_admin) || auth()->user()->is_admin != 1) {
        abort(403, 'Unauthorized');
    }

    return $next($request);
}

}
