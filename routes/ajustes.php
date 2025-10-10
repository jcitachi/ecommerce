<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjusteController;

Auth::routes();

Route::get('/admin/ajustes', [AjusteController::class, 'index'])->name('admin.ajustes.index')->middleware('auth');

