<?php

use App\Http\Controllers\Administrator\UserAccountController;
use App\Http\Controllers\HumanResource\EmployeeController;
use App\Http\Controllers\Purchasing\SupplierController;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\Warehouse\UnitController;
use Illuminate\Support\Facades\Route;

Route::controller(SessionController::class)
    ->prefix('login')
    ->name('login.')
    ->group(function() {
    route::get('/', 'create')->name('create');
    route::post('/', 'store')->name('store');
})->middleware('guest');


Route::middleware('auth')->group(function() {

    Route::get('dashboard', function() {
        return view('dashboard.modules.dashboard.index');
    })->name('dashboard');

    Route::resource('management/human-resource', EmployeeController::class)
        ->only(['index', 'create', 'store', 'show', 'edit'])
        ->names('employees');

    Route::resource('administrator/user-accounts', UserAccountController::class)
        ->only(['index', 'create', 'store', 'show', 'update'])
        ->names('user-accounts');

    // Route::put('administrator/user-accounts/user-info', [UserInfoController::class, 'updatedUserInfo'])->name('updateuserinfo.update');
    // Route::patch('/user-login/update', [UserInfoController::class, 'updatedUserLogin']);

    Route::controller(SupplierController::class)
            ->prefix('purchasing/supplier')
            ->name('supplier.')
            ->group(function() {
    Route::get('/',        'index')->name('index');
    Route::get('/create',  'create')->name('create');
    });

Route::controller(UnitController::class)
        ->prefix('warehouse/units')
        ->name('units.')
        ->group(function() {
    Route::get('/',        'index')->name('index');
    Route::get('/create',  'create')->name('create');
    Route::post('/',       'store')->name('store');
    });


});

