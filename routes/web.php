<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ProductManager;
use App\Livewire\CategoryManager;
use App\Livewire\UserManager;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:Administrator|User'])->group(function () {
    Route::get('/products', [ProductManager::class, '__invoke'])->name('products');
    Route::get('/categories', [CategoryManager::class, '__invoke'])->name('categories');
});

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::get('/users', [UserManager::class, '__invoke'])->name('users'); // Create UserManager similarly
});
