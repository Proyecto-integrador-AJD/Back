<?php 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\{Route, App};
use App\Http\Controllers\{
    EquipController,
    EstadiController,
    JugadorasController,
    PartitsController 
};
use App\Models\{Partit, User};
use App\Mail\CalendarioArbitros;

use App\Http\Middleware\RoleMiddleware;

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



require __DIR__.'/auth.php';
