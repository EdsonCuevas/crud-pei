<?php

// Controladores para el panel Administrador
use App\Http\Controllers\BeneficiariesController;
use App\Http\Controllers\CoordiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonorsController;
use App\Http\Controllers\VolunteersController;
use App\Http\Controllers\ProgramsController;

// Controladores para el panel Coordinador
use App\Http\Controllers\CoordProgramController;
use App\Http\Controllers\CoordReportsController;

// Controladores para el panel Voluntario
use App\Http\Controllers\VoluntProgramsController;
use App\Http\controllers\VoluntContactController;

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


Route::middleware('auth')->group(function () {
    Route::get('/about', fn() => Inertia::render('About'))->name('about');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('admin-coordinators', CoordiController::class);
    Route::resource('admin-volunteers', VolunteersController::class);
    Route::resource('admin-donors', DonorsController::class);
    Route::resource('admin-beneficiaries', BeneficiariesController::class);
    Route::resource('admin-programs', ProgramsController::class);

    Route::resource('coord-programs', CoordProgramController::class);
    Route::resource('coord-reports', CoordReportsController::class);

    Route::resource('volunt-programas', VoluntProgramsController::class);
    Route::resource('volunt-contactos', VoluntContactController::class);
});

require __DIR__ . '/auth.php';
