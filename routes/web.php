<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramsController;
// Controladores para el panel Administrador
use App\Http\Controllers\AdminBeneficiariesController;
use App\Http\Controllers\AdminCoordiController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDonorsController;
use App\Http\Controllers\AdminVolunteersController;
use App\Http\Controllers\AdminProgramsController;
use App\Http\Controllers\AdminMyInfoController;


// Controladores para el panel Coordinador
use App\Http\Controllers\CoordMyInfoController;
use App\Http\Controllers\CoordProgramController;
use App\Http\Controllers\CoordReportsController;
use App\Http\Controllers\CoordPeticionesController;

use App\Http\Controllers\ExportController;

// Controladores para el panel Voluntario
use App\Http\Controllers\VoluntExpensesController;
use App\Http\controllers\VoluntContactController;
use App\Http\Controllers\VoluntMyInfoController;


// Controladores para el panel Donador
use App\Http\Controllers\DonorMyInfoController;
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

use App\Http\Controllers\ProgramsExportController;
use Maatwebsite\Excel\Facades\Excel;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/programs', [ProgramsController::class, 'index'])->name('programs');
Route::get('/', [ExportController::class, 'index'])->name('index');
Route::get('/export/{roleId}', [ExportController::class, 'export'])->name('export');

Route::get('/export-programs', function () {
    return Excel::download(new ProgramsExportController, 'programs.xlsx');
});


//Ruta PDF 
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/details-donation', function () {
    return Inertia::render('Donador/Detailsdonation');
})->name('details-donation');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

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


    Route::get('401', fn() => inertia::render('401'))->name('401');

    Route::get('dashboard', [MainController::class, 'autoredirect']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para admin
    Route::resource('admin-dashboard', AdminDashboardController::class);
    Route::resource('admin-coordinators', AdminCoordiController::class);
    Route::resource('admin-volunteers', AdminVolunteersController::class);
    Route::resource('admin-donors', AdminDonorsController::class);
    Route::resource('admin-beneficiaries', AdminBeneficiariesController::class);
    Route::resource('admin-programs', AdminProgramsController::class);
    Route::get('admin-programs-pdf', [AdminProgramsController::class, 'pdf']);
    Route::post('updateProgram', [AdminProgramsController::class, 'updateprogram'])->name('updateprogram');

    // Rutas para coordinadores
    Route::resource('coord-programs', CoordProgramController::class);
    Route::resource('coord-reports', CoordReportsController::class);
    Route::resource('coord-peticiones', CoordPeticionesController::class);


    // Rutas para voluntarios
    Route::resource('volunt-expenses', VoluntExpensesController::class);
    Route::resource('volunt-contactos', VoluntContactController::class);

    // Rutas para donadores
    Route::resource('donor-donations', DonorDonacionesController::class);
    Route::resource('donor-contacts', DonorContactosController::class);

    // Rutas para beneficiarios
    Route::resource('benef-myinfo', MyInfoController::class)->only(['index']);

    // Rutas para coordinadores
    Route::resource('coord-myinfo', CoordMyInfoController::class)->only(['index']);
    Route::resource('admin-myinfo', AdminMyInfoController::class)->only(['index']);
    Route::resource('donor-myinfo', DonorMyInfoController::class)->only(['index']);
    Route::resource('volunt-myinfo', VoluntMyInfoController::class)->only(['index']);



    Route::resource('benef-recursos', BenefRecursosController::class);
    Route::post('/benef-recursos/register', [BenefRecursosController::class, 'registerUserToProgram'])->name('programs.register');
    Route::resource('benef-contacts', BenefContactsController::class);
});

require __DIR__ . '/auth.php';
