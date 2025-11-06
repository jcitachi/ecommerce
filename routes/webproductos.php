<?php

use Illuminate\Support\Facades\Route;

//rutas la landing page

Route::get('/', [App\Http\Controllers\WebController::class, 'index'])->name('web.index');



