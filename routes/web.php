<?php

use App\Livewire\Cart;
use App\Livewire\ProductList;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/', ProductList::class)->middleware('auth')->name('products');
Route::get('/cart', Cart::class)->middleware('auth')->name('cart.index');

require __DIR__.'/auth.php';
