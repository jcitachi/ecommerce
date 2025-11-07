<?php

use Illuminate\Support\Facades\Route;

//rutas la landing page

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('web.dashboard');
Route::get('/carrito', [App\Http\Controllers\DashboardController::class, 'carrito'])->name('web.carrito');
Route::get('/web/login', [App\Http\Controllers\DashboardController::class, 'login'])->name('web.login');
Route::post('/web/login', [App\Http\Controllers\DashboardController::class, 'autenticacion'])->name('web.autenticacion');
Route::get('/web/resgistro', [App\Http\Controllers\DashboardController::class, 'registro'])->name('web.registro');
Route::post('/web/resgistro', [App\Http\Controllers\DashboardController::class, 'crear_cuenta'])->name('web.crear_cuenta');
