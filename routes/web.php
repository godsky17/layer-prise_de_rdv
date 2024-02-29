<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\RdvController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RendezvousController;
use App\Models\Etat;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('visiteur.index');})->name('index');

Route::get('/rendez-vous', function () {return view('visiteur.form');})->name('getrdv');

Route::post('/rendez-vous', [RendezvousController::class, 'store'])->name('saveRdv');

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('auth.doLogin');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('administration')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', function(){
        return view('admin.index');
    })->name('index');

    Route::get('/signup', function(){
        return view('admin.signup');
    })->name('signup');

    Route::get('/signin', function(){
        return view('admin.signin');
    })->name('signin');

    Route::get('/Rendez-vous', [RdvController::class, 'index'])->name('rdv');

    Route::get('/Rendez-vous/{item}/annuler', [RdvController::class, 'annuler'])->name('annuler');

    Route::get('/Rendez-vous/{item}/reprogrammer', [RdvController::class, 'reprogrammer'])->name('reprogrammer');
    Route::post('/Rendez-vous/{item}/reprogrammer', [RdvController::class, 'update'])->name('save');
    Route::get('/calendrier', function(){
        return view('admin.calendrier');
    })->name('calendrier');

    Route::get('/Liste des administrateurs', [AdminController::class, "index"])->name('gestion');
    Route::post('/modificaions-admin', [AdminController::class, "updateAdmin"])->name('update.admin');
    Route::post('/modificaions-sadmin', [AdminController::class, "updateSadmin"])->name('update.sadmin');
    Route::get('/retirer', [AdminController::class, "retier"])->name('retirer');
    Route::get('/creer un admin', [AdminController::class, "create"])->name('create');
    Route::post('/creer un admin', [AdminController::class, "store"])->name('store');
});


