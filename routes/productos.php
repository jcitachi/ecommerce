<?php

use Illuminate\Support\Facades\Route;


Route::get('/admin/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('admin.productos.index')->middleware('auth');
Route::get('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('admin.productos.create')->middleware('auth');
Route::post('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'store'])->name('admin.productos.store')->middleware('auth');
Route::get('/admin/producto/{id}', [App\Http\Controllers\ProductoController::class, 'show'])->name('admin.productos.show')->middleware('auth');
Route::get('/admin/producto/{id}/imagenes', [App\Http\Controllers\ProductoController::class, 'imagenes'])->name('admin.productos.imagenes')->middleware('auth');
Route::post('/admin/producto/{id}/upload_imagen', [App\Http\Controllers\ProductoController::class, 'upload_imagen'])->name('admin.productos.upload_imagen')->middleware('auth');
Route::delete('/admin/producto/imagen/{id}/destroy_imagen', [App\Http\Controllers\ProductoController::class, 'destroy_imagen'])->name('admin.productos.destroy_imagen')->middleware('auth');
Route::get('/admin/producto/{id}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('admin.productos.edit')->middleware('auth');
Route::put('/admin/producto/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('admin.productos.update')->middleware('auth');
Route::delete('/admin/producto/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('admin.productos.destroy')->middleware('auth');

Route::get('/productos/{id}', [App\Http\Controllers\ProductoController::class, 'detalle_producto'])->name('web.detalle_producto');
