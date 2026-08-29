<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\Auth\CustomerAuthController;
use App\Livewire\Customer\Store;
use App\Livewire\Admin\Rentals\Index as RentalIndex;
use App\Livewire\Customer\Rentals\Index as CustomerRentalIndex;
use App\Livewire\Customer\Profile;
use App\Livewire\Admin\Customers\Index as CustomerIndex;
use App\Livewire\Admin\Dashboard;

//Route::view('/', 'welcome')->name('home');
Route::view('/', 'landing')
    ->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)
        ->name('dashboard');

    Route::get('equipment', \App\Livewire\Admin\Equipment\Index::class)
        ->name('equipment.index');

    Route::get('/rentals', RentalIndex::class)
        ->name('rentals.index');
    
    Route::get('/customers', CustomerIndex::class)
        ->name('customers.index');

});

Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('login', function () {
        return view('customer.auth.login');
    })->name('login');

    Route::post('login', [CustomerAuthController::class, 'login'])->name('login.submit');
    
    Route::get('register', function () {
        return view('customer.auth.register');
    })->name('register');

    Route::post('register', [CustomerAuthController::class, 'register'])
        ->name('register.submit');

    Route::get('store', \App\Livewire\Customer\Store::class)
        ->name('store');
        
    Route::middleware(['auth:customer'])->group(function () {
  
        Route::get('rentals', CustomerRentalIndex::class)
            ->name('rentals');
        
        Route::get('profile', Profile::class)
            ->name('profile');
        
        Route::post('logout', [CustomerAuthController::class, 'logout'])->name('logout');
    });

});  

require __DIR__.'/settings.php';
