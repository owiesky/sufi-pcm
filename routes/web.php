<?php

use App\Livewire\Actions\Logout;
use App\Livewire\Master\UserIndex;
use App\Livewire\Master\CustomerIndex;
use App\Livewire\Master\SupplierIndex;
use Illuminate\Support\Facades\Route;
//use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'dashboard')
    ->middleware(['auth'])->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::group(['middleware' => ['auth',  'role:ADMIN|PROJECTMANAGER']], function () {
    Route::get('/user', UserIndex::class)
        ->name('user-index');

    Route::get('/customer', CustomerIndex::class)
        ->name('customer-index');

    Route::get('/supplier', SupplierIndex::class)
        ->name('supplier-index');

    // Volt::route('/customer', 'customer.index')
    //     ->name('customer-index');
});

// Route::get('/supplier', SupplierIndex::class)
//     ->middleware(['auth', 'role:PROJECTMANAGER'])
//     ->name('supplier-index');

// Volt::route('/customer', 'customer.index')
//     ->middleware(['auth'])
//     ->name('customer-index');


Route::get('/logout', [Logout::class, 'doLogout']);

require __DIR__ . '/auth.php';
