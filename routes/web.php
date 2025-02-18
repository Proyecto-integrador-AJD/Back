<?php 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\{Route, App};
use App\Http\Controllers\{
    ZoneController,
    UserController,
    PatientController
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
   

});


require __DIR__.'/auth.php';
