<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'cfo' => \App\Http\Middleware\CFOMiddleware::class,
            'fso' => \App\Http\Middleware\FSOMiddleware::class,
            'citizen' => \App\Http\Middleware\CitizenMiddleware::class,
            'staff' => \App\Http\Middleware\StaffMiddleware::class,
            'auth.check' => \App\Http\Middleware\MyMiddleware::class,
            'MyMiddleware' => \App\Http\Middleware\MyMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
