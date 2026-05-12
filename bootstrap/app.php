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
        // Tambahkan baris sakti ini, Partner!
        $middleware->redirectTo(
            guests: '/login',         // Jika belum login dilempar ke sini
            users: '/admin/dashboard'  // JIKA LOGIN BERHASIL, PAKSA KE SINI
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
