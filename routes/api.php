<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{AuthController, AlertSubtypeController, PatientController, AlertTypeController, RecurrenceTypeController, ContactController, ZoneController, LanguageController, AlertController, CallController, UserController, RelationshipController, PrefixController};
use App\Http\Middleware\AdminPermissionsMiddleware;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::apiResource('jugadoras', JugadoraController::class)->middleware('api');


Route::post('login', [AuthController::class, 'login'])->middleware('api');
Route::post('register', [AuthController::class, 'register'])->middleware('api');


Route::middleware(['auth:sanctum','api'])->group( function () {
    Route::apiResource('prefix',  PrefixController::class);
    Route::apiResource('language',  LanguageController::class);
    Route::get('patients/current',  [PatientController::class, 'current']);
    Route::apiResource('patients',  PatientController::class);
    Route::apiResource('relationship',  RelationshipController::class);
    Route::apiResource('contacts',  ContactController::class);
    Route::apiResource('zones',  ZoneController::class);
    Route::apiResource('alert/types',  AlertTypeController::class);
    Route::apiResource('alert/subtypes',  AlertSubtypeController::class);
    Route::apiResource('alert/recurrence',  RecurrenceTypeController::class);
    Route::apiResource('alerts',  AlertController::class);
    Route::apiResource('calls',  CallController::class);


    Route::get('user',  [AuthController::class, 'user']);

    Route::middleware(['auth', AdminPermissionsMiddleware::class])->group(function (){
        Route::apiResource('users',  UserController::class);
    });

    Route::post('logout', [AuthController::class, 'logout']);
});