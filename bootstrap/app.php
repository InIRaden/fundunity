<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust Railway's reverse proxy so HTTPS URLs are generated correctly.
        // Railway terminates SSL at the proxy layer and forwards requests internally via HTTP,
        // sending X-Forwarded-Proto: https — Laravel must trust this header.
        $middleware->trustProxies(at: '*');

        $middleware->web(append: [
            \App\Http\Middleware\EnsurePublicSiteAvailable::class,
        ]);

        $middleware->alias([
            'force-change-password' => \App\Http\Middleware\ForceChangePassword::class,
            'super-admin'           => \App\Http\Middleware\SuperAdminOnly::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
