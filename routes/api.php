<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{AuthController, AlertSubtypeController, PatientController, AlertTypeController, RecurrenceTypeController, ContactController, ZoneController, LanguageController, AlertController, CallController, UserController, RelationshipController, PrefixController, ReportController, TypeCallController, SubTypeCallController};
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

    Route::apiResource('language', LanguageController::class)->names([
        'index'   => 'api.language.list',
        'store'   => 'api.language.store',
        'show'    => 'api.language.show',
        'update'  => 'api.language.update',
        'destroy' => 'api.language.delete',
    ]);

    Route::get('patients/current', [PatientController::class, 'current'])->name('api.patients.current');

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

    Route::get('/zones/{id}/patients', [PatientController::class, 'getPatientsByZone'])->name('api.zones.patients');

    Route::apiResource('alert/types', AlertTypeController::class)->names([
        'index'   => 'api.alert.types.list',
        'store'   => 'api.alert.types.store',
        'show'    => 'api.alert.types.show',
        'update'  => 'api.alert.types.update',
        'destroy' => 'api.alert.types.delete',
    ]);

    Route::apiResource('alert/subtypes', AlertSubtypeController::class)->names([
        'index'   => 'api.alert.subtypes.list',
        'store'   => 'api.alert.subtypes.store',
        'show'    => 'api.alert.subtypes.show',
        'update'  => 'api.alert.subtypes.update',
        'destroy' => 'api.alert.subtypes.delete',
    ]);

    Route::apiResource('alert/recurrence', RecurrenceTypeController::class)->names([
        'index'   => 'api.alert.recurrence.list',
        'store'   => 'api.alert.recurrence.store',
        'show'    => 'api.alert.recurrence.show',
        'update'  => 'api.alert.recurrence.update',
        'destroy' => 'api.alert.recurrence.delete',
    ]);

    Route::get('/alerts/unassigned', [AlertController::class, 'unassigned'])->name('api.alerts.unassigned');
    Route::get('/alerts/user', [AlertController::class, 'user'])->name('api.alerts.user');

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

    Route::apiResource('call/types', TypeCallController::class)->names([
        'index'   => 'api.call.types.list',
        'store'   => 'api.call.types.store',
        'show'    => 'api.call.types.show',
        'update'  => 'api.call.types.update',
        'destroy' => 'api.call.types.delete',
    ]);

    Route::apiResource('call/subtypes', SubTypeCallController::class)->names([
        'index'   => 'api.call.subtypes.list',
        'store'   => 'api.call.subtypes.store',
        'show'    => 'api.call.subtypes.show',
        'update'  => 'api.call.subtypes.update',
        'destroy' => 'api.call.subtypes.delete',
    ]);

    Route::get('patients/{id}/calls', [CallController::class, 'getCallsByPatient'])->name('api.patients.calls');


    Route::prefix('reports')->group(function () {
        Route::get('/emergencies', [ReportController::class, 'getEmergencyReports']);
        Route::get('/patients', [ReportController::class, 'getPatientsSorted']);
        Route::get('/scheduled-calls', [ReportController::class, 'getScheduledCalls']);
        Route::get('/done-calls', [ReportController::class, 'getDoneCalls']);
        Route::get('/patienthistory/{id}', [ReportController::class, 'getPatientCallHistory']);
        Route::get('/calls', [ReportController::class, 'getReportCalls']);
        Route::get('/pdf/calls/pdf', [ReportController::class, 'getPDFcalls']);
        Route::get('/pdf/calls/csv', [ReportController::class, 'getCSVcalls']);
    });

    Route::get('user',  [AuthController::class, 'user']);

    Route::middleware(['auth', AdminPermissionsMiddleware::class])->group(function (){
        Route::apiResource('users', UserController::class)->names([
            'index'   => 'api.users.list',
            'store'   => 'api.users.store',
            'show'    => 'api.users.show',
            'update'  => 'api.users.update',
            'destroy' => 'api.users.delete',
        ]);
    });

    Route::post('logout', [AuthController::class, 'logout']);
});