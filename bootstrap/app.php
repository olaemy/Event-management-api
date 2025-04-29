<?php

// use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// use Illuminate\Support\Facades\RateLimiter;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Global middleware (applies to all routes)
        $middleware->use([
            \Illuminate\Session\Middleware\StartSession::class,
        ]);

        $middleware->group('web', [
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class => [
                'except' => ['api/*'], // Exclude all API routes from CSRF protection
            ]
        ]);

        $middleware->group('api', [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
            // \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class => [
            //     'except' => ['api/*'] // Exclude all API routes from CSRF
            // ],
            // \Illuminate\Routing\Middleware\ValidateSignature::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
