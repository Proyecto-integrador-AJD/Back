<?php 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\{Route, App};
use App\Http\Controllers\{
    ZoneController,
    UserController,
    PatientController, 
    CallController,
    AlertController,
    AlertTypeController,
    ContactController
};
use App\Models\{Partit, User};
use App\Mail\CalendarioArbitros;

use App\Http\Middleware\RoleMiddleware;

App::setLocale('es');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('home.index');
});


Route::middleware(['auth', RoleMiddleware::class.':administrator' ])->group(function (){
    Route::resource('/zones', ZoneController::class);

    Route::resource('/users', UserController::class);

    Route::resource('/patients', PatientController::class);

    Route::resource('/calls', CallController::class);

    Route::resource('/alerts', AlertController::class);

    Route::get('/alert-types', [AlertTypeController::class, 'index']);


    Route::resource('/contacts', ContactController::class);
   

});


require __DIR__.'/auth.php';
