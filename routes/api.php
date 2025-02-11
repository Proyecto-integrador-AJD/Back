<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{AuthController, PatientController, ContactController, ZoneController, AlertController, CallController, UserController, RelationshipController, PrefixController};
use App\Http\Middleware\AdminPermissionsMiddleware;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::apiResource('jugadoras', JugadoraController::class)->middleware('api');


Route::post('login', [AuthController::class, 'login'])->middleware('api');
Route::post('register', [AuthController::class, 'register'])->middleware('api');


Route::middleware(['auth:sanctum','api'])->group( function () {
    Route::apiResource('prefix', PrefixController::class)->names([
        'index'   => 'api.prefix.list',
        'store'   => 'api.prefix.store',
        'show'    => 'api.prefix.show',
        'update'  => 'api.prefix.update',
        'destroy' => 'api.prefix.delete',
    ]);

    Route::apiResource('patients', PatientController::class)->names([
        'index'   => 'api.patients.list',
        'store'   => 'api.patients.store',
        'show'    => 'api.patients.show',
        'update'  => 'api.patients.update',
        'destroy' => 'api.patients.delete',
    ]);

    Route::apiResource('relationship', RelationshipController::class)->names([
        'index'   => 'api.relationship.list',
        'store'   => 'api.relationship.store',
        'show'    => 'api.relationship.show',
        'update'  => 'api.relationship.update',
        'destroy' => 'api.relationship.delete',
    ]);

    Route::apiResource('contacts', ContactController::class)->names([
        'index'   => 'api.contacts.list',
        'store'   => 'api.contacts.store',
        'show'    => 'api.contacts.show',
        'update'  => 'api.contacts.update',
        'destroy' => 'api.contacts.delete',
    ]);

    Route::apiResource('zones', ZoneController::class)->names([
        'index'   => 'api.zones.list',
        'store'   => 'api.zones.store',
        'show'    => 'api.zones.show',
        'update'  => 'api.zones.update',
        'destroy' => 'api.zones.delete',
    ]);

    Route::apiResource('alerts', AlertController::class)->names([
        'index'   => 'api.alerts.list',
        'store'   => 'api.alerts.store',
        'show'    => 'api.alerts.show',
        'update'  => 'api.alerts.update',
        'destroy' => 'api.alerts.delete',
    ]);

    Route::apiResource('calls', CallController::class)->names([
        'index'   => 'api.calls.list',
        'store'   => 'api.calls.store',
        'show'    => 'api.calls.show',
        'update'  => 'api.calls.update',
        'destroy' => 'api.calls.delete',
    ]);


    Route::get('user',  [AuthController::class, 'user']);

    Route::middleware(['auth', AdminPermissionsMiddleware::class])->group(function (){
        Route::apiResource('users',  UserController::class);
    });

    Route::post('logout', [AuthController::class, 'logout']);
});