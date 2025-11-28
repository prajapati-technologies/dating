<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware): void {

    // ✅ Register admin middleware alias
    $middleware->alias([
        'blocked' => \App\Http\Middleware\BlockedUserMiddleware::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);

    // ✅ Existing API group (leave as is)
    $middleware->group('api', [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ]);
})

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
