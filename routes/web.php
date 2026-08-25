<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewPartsRequestController;
use App\Http\Controllers\NewVehiclesRequestController;
use App\Http\Controllers\ManagePartsRequestController;
use App\Http\Controllers\ManageVehiclesRequestController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/sub-dealer/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/sub-dealer/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/sub-dealer/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['web'])->prefix('sub-dealer')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/new-parts-request', [NewPartsRequestController::class, 'index'])->name('parts.new');
    Route::get('/new-vehicles-request', [NewVehiclesRequestController::class, 'index'])->name('vehicles.new');

    Route::get('/manage-parts-request', [ManagePartsRequestController::class, 'index'])->name('parts.manage');
    Route::get('/manage-vehicles-request', [ManageVehiclesRequestController::class, 'index'])->name('vehicles.manage');
});