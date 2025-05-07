<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VehicleController;

Route::get('/', function () {
    return view('dashboard');
});

// Ruta Dashboard  
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Rutas para Clientes
Route::resource('clients', ClientController::class);

// Rutas para Vehículos
Route::resource('vehicles', VehicleController::class);
