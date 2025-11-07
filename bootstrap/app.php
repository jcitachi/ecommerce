<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web:
        [
            __DIR__.'/../routes/web.php',
            __DIR__.'/../routes/admin.php',
            __DIR__.'/../routes/ajustes.php',
            __DIR__.'/../routes/roles.php',
             __DIR__.'/../routes/usuarios.php',
             __DIR__.'/../routes/categorias.php',
             __DIR__.'/../routes/productos.php',
             __DIR__.'/../routes/webproductos.php',
             __DIR__.'/../routes/dashboard.php',
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
