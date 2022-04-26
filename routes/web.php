<?php

use App\Http\Controllers\ShipController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MapController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function() {
    // region Ship Begin
    Route::get('/dashboard', [ShipController::class, 'index'])->name('dashboard');
    Route::get('/ship/create', [ShipController::class, 'create'])->name('ship.create');
    Route::post('/ship', [ShipController::class, 'store'])->name('ship.store');
    Route::get('/ship/{ship}/upload',[ShipController::class,'upload'])->name('ship.upload');
    Route::post('/ship/{ship}/upload',[ShipController::class,'uploadStore'])->name('ship.upload.store');
    Route::get('/ship/{ship}/edit',[ShipController::class, 'edit'])->name('ship.edit');
    Route::put('/ship/{ship}',[ShipController::class,'update'])->name('ship.update');
    Route::delete('/ship/{ship}',[ShipController::class,'destroy'])->name('ship.destroy');
    // region Ship End


    Route::get('/device', [DeviceController::class, 'index'])->name('device');
    Route::get('/device/create', [DeviceController::class, 'create'])->name('device.create');
    Route::post('/device', [DeviceController::class, 'store'])->name('device.store');
    Route::get('/device/upload', [DeviceController::class, 'upload'])->name('device.upload');
    Route::post('/device/upload', [DeviceController::class, 'uploadStore'])->name('device.upload.store');
    Route::get('/device/{device}/edit', [DeviceController::class, 'edit'])->name('device.edit');
    Route::put('/device/{device}', [DeviceController::class, 'update'])->name('device.update');
    Route::delete('/device/{device}', [DeviceController::class, 'destroy'])->name('device.destroy');

    Route::get('/map',[MapController::class, 'index'])->name('map');
});

require __DIR__.'/auth.php';
