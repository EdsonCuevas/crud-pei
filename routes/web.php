<?php

// Controladores para el panel Administrador
use App\Http\Controllers\AdminBeneficiariesController;
use App\Http\Controllers\AdminCoordiController;
use App\Http\Controllers\AdminDonorsController;
use App\Http\Controllers\AdminVolunteersController;
use App\Http\Controllers\AdminProgramsController;

// Controladores para el panel Coordinador
use App\Http\Controllers\CoordProgramController;
use App\Http\Controllers\CoordReportsController;

// Controladores para el panel Voluntario
use App\Http\Controllers\VoluntProgramsController;
use App\Http\controllers\VoluntContactController;

// Controladores para el panel Donador
use App\Http\Controllers\DonorDonacionesController;
use App\Http\Controllers\DonorInformesController;
use App\Http\Controllers\DonorContactosController;

// Controladores para el panel Beneficiario
use App\Http\Controllers\MyInfoController;
use App\Http\Controllers\BenefContactsController;
use App\Http\Controllers\BenefRecursosController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\MainController;

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

Route::get('/home', function () {
    return Inertia::render('HomePage');
})->name('home');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/terms-conditions', function () {
    return Inertia::render('Terminos&condiciones');
})->name('terminos.condiciones');

Route::get('/', function () {
    return redirect('/home');
});


Route::middleware('auth')->group(function () {
    Route::get('/about', fn() => Inertia::render('About'))->name('about');

    Route::get('401', fn() => inertia::render('401'))->name('401');

    Route::get('dashboard', [MainController::class, 'autoredirect']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('admin-coordinators', AdminCoordiController::class);
    Route::resource('admin-volunteers', AdminVolunteersController::class);
    Route::resource('admin-donors', AdminDonorsController::class);
    Route::resource('admin-beneficiaries', AdminBeneficiariesController::class);
    Route::resource('admin-programs', AdminProgramsController::class);
    Route::post('updateProgram', [AdminProgramsController::class, 'updateprogram'])->name('updateprogram');

    Route::resource('coord-programs', CoordProgramController::class);
    Route::resource('coord-reports', CoordReportsController::class);

    Route::resource('volunt-programas', VoluntProgramsController::class);
    Route::resource('volunt-contactos', VoluntContactController::class);

    Route::resource('donor-donations', DonorDonacionesController::class);

    Route::resource('donor-contacts', DonorContactosController::class);
    Route::resource('donor-informes', DonorInformesController::class);

    Route::resource('benef-myinfo', MyInfoController::class);
    Route::resource('benef-recursos', BenefRecursosController::class);
    Route::resource('benef-contacts', BenefContactsController::class);
});

require __DIR__ . '/auth.php';
