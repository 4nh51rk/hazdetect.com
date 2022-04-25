<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/credentials/{imei}', [ApiController::class, 'getCredentials']);
// Route::post('/credentials/{imei}', [ApiController::class, 'getCredentials']);
Route::match(array('GET','POST'),'/credentials/{imei}', [ApiController::class, 'getCredentials']);

Route::post('/tb',[ApiController::class,'toThingsBoard']);
Route::post('/tb0',[ApiController::class,'toThingsBoard']);
