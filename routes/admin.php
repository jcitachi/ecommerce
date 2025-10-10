<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Auth::routes();

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');

