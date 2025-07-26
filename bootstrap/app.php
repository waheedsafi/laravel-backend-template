<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\v1\language\LocaleMiddleware;
use App\Http\Middleware\v1\user\CheckUserAccessMiddleware;
use App\Http\Middleware\v1\user\sub\HasSubPermissionMiddleware;
use App\Http\Middleware\v1\user\main\HasMainPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append([
            \Illuminate\Http\Middleware\HandleCors::class,
            LocaleMiddleware::class
        ])
            ->alias([
                'userHasMainPermission' => HasMainPermissionMiddleware::class,
                'userHasSubPermission' => HasSubPermissionMiddleware::class,
                'checkUserAccess'  => CheckUserAccessMiddleware::class,
            ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
