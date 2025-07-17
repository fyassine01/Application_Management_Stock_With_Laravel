<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\userProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandeController;
/*
Route::get('/', function () {
    return view('login');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/shop', [ShopController::class, 'index'])->middleware(['auth', 'verified'])->name('shop');

Route::middleware('auth')->group(function () {
    Route::post('/shop/create-order', [ShopController::class, 'createOrder'])->name('shop.createOrder');
    Route::get('/search', [ShopController::class, 'search'])->name('search');
    Route::get('/profile/n', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/n', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/n', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/{id}', [CommandeController::class, 'show'])->name('commandes.show');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [userProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [userProfileController::class, 'update'])->name('profile.update');
});


Route::get('/about', function () {
    return view('about');
})->name('about')->middleware(['auth']);




require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
