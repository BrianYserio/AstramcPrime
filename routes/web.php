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

Route::controller(EmployeeController::class)
    ->prefix('management/human-resource')
    ->name('employees.')
    ->group(function () {
        Route::get('/',          'index')  ->name('index');
        Route::get('/create',    'create') ->name('create');
        Route::post('/',         'store')  ->name('store');
        Route::get('/{id}',      'show')   ->name('show');
        Route::get('/{id}/edit', 'edit')   ->name('edit');
        Route::put('/{id}',      'update') ->name('update');
    });

Route::controller(UserAccountController::class)
        ->prefix('administrator/user-accounts')
        ->name('user-accounts.')
        ->group(function() {
Route::get('/',        'index')->name('index');
Route::get('/create',  'create')->name('create');
Route::post('/',       'store')->name('store');
Route::get('/{id}',    'show')   ->name('show');
});

Route::controller(SupplierController::class)
        ->prefix('purchasing/supplier')
        ->name('supplier.')
        ->group(function() {
Route::get('/',        'index')->name('index');
Route::get('/create',  'create')->name('create');
// Route::post('/',       'store')->name('store');
// Route::get('/{id}',    'show')   ->name('show');
});


Route::controller(UnitController::class)
        ->prefix('warehouse/units')
        ->name('units.')
        ->group(function() {
Route::get('/',        'index')->name('index');
Route::get('/create',  'create')->name('create');
// Route::post('/',       'store')->name('store');
// Route::get('/{id}',    'show')   ->name('show');
});
// Route::patch('user-accounts/{id}/info',        [..., 'update.info']);
// Route::patch('user-accounts/{id}/credentials', [..., 'update.credentials']);
// Route::patch('user-accounts/{id}/permissions', [..., 'update.permissions']);
