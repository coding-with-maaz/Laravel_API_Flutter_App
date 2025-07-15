<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('products', [ProductController::class, 'webIndex'])->name('products.index');
Route::post('products', [ProductController::class, 'webStore'])->name('products.store');
Route::get('products/{product}/edit', [ProductController::class, 'webEdit'])->name('products.edit');
Route::put('products/{product}', [ProductController::class, 'webUpdate'])->name('products.update');
Route::delete('products/{product}', [ProductController::class, 'webDestroy'])->name('products.destroy');
