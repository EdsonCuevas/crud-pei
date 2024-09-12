<?php

use App\Http\Controllers\BeneficiariesController;
use App\Http\Controllers\CoordiController;
use App\Http\Controllers\VoluntController;
use App\Http\controllers\ContacVoluntController;
use App\Http\Controllers\DonorsController;
use App\Http\Controllers\VolunteersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramsController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', fn() => Inertia::render('About'))->name('about');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('coordinators', CoordiController::class);
    Route::resource('volunteers', VolunteersController::class);
    Route::resource('donors', DonorsController::class);
    Route::resource('beneficiaries', BeneficiariesController::class);

    Route::resource('programs', ProgramsController::class);

    Route::resource('voluntarios', VoluntController::class);
    Route::resource('contactos', ContacVoluntController::class);
});

require __DIR__ . '/auth.php';
