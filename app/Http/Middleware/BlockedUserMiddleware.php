<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockedUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_blocked == 1) {
            auth()->logout();
            return redirect('/login')->withErrors([
                'email' => 'Your account has been blocked by admin.'
            ]);
        }

        return $next($request);
    }
}
