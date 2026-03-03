<?php

use App\Http\Controllers\Users\AuthenticatedSessionController;
use App\Http\Controllers\HumanResource\EmployeeController;
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
        ->prefix('management')
        ->name('employees.')
        ->group(function() {
    Route::get('human-resource/', 'index')->name('index');
    Route::get('human-resource/create', 'create')->name('create');
    Route::post('human-resource/', 'store')->name('store');
    Route::get('human-resource/{id}', 'show')->name('show');
    Route::get('human-resource/{id}/edit', 'edit')->name('edit');
});
