<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{AuthController, PatientController, ZoneController};


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::apiResource('jugadoras', JugadoraController::class)->middleware('api');


Route::post('login', [AuthController::class, 'login'])->middleware('api');
Route::post('register', [AuthController::class, 'register'])->middleware('api');


Route::middleware(['auth:sanctum','api'])->group( function () {
    Route::apiResource('patients',  PatientController::class);
    Route::apiResource('zones',  ZoneController::class);

    Route::post('logout', [AuthController::class, 'logout']);
});