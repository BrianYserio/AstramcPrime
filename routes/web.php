<?php

use App\Http\Controllers\Administrator\UserAccountController;
use App\Http\Controllers\HumanResource\EmployeeController;
use App\Http\Controllers\Purchasing\SupplierController;
use App\Http\Controllers\Users\AuthenticatedSessionController;
use App\Http\Controllers\Warehouse\UnitController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthenticatedSessionController::class)
    ->prefix('login')
    ->name('login.')
    ->group(function() {
    route::get('/', 'create')->name('create');
    route::post('/', 'store')->name('store');
});

Route::get('dashboard', function() {
    return view('dashboard.modules.dashboard.index');
})->name('dashboard');


Route::resource('management/human-resource', EmployeeController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update'])
    ->names('employees');

Route::resource('administrator/user-accounts', UserAccountController::class)
    ->only(['index', 'create', 'store', 'show'])
    ->names('user-accounts');

Route::controller(SupplierController::class)
        ->prefix('purchasing/supplier')
        ->name('supplier.')
        ->group(function() {
Route::get('/',        'index')->name('index');
Route::get('/create',  'create')->name('create');
// Route::post('/',       'store')->name('store');
// Route::get('/{id}',    'show')   ->name('show');
});

// Protected routes
Route::middleware(['auth'])->group(function () {
        Route::controller(UnitController::class)
            ->prefix('warehouse/units')
            ->name('units.')
            ->group(function() {
        Route::get('/',        'index')->name('index');
        Route::get('/create',  'create')->name('create');
        Route::post('/',       'store')->name('store');
    // Route::get('/{id}',    'show')   ->name('show');
    });
});
