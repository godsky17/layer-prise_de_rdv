<?php

use App\Http\Controllers\admin\RdvController;
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

Route::prefix('administration')->name('admin.')->group(function () {
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
});

Route::get('/brouillon', function(){
    $nowBegin =  new Carbon('08:00');
    $nowEnd =  new Carbon('12:0');
    $existBegin =  new Carbon('12:00');
    $existEnd = new Carbon('18:00');

    $condition1 = ($nowBegin >= $existBegin) && ($nowBegin >= $existEnd) && ($nowEnd >= $existBegin ) && ($nowEnd >= $existBegin);
    $condition2 = ($nowBegin <= $existBegin) && ($nowBegin <= $existEnd) && ($nowEnd <= $existBegin ) && ($nowEnd <= $existBegin);

    if ($condition1 || $condition2) {
        dd('true');
    } else {
        dd('false');
    }
    

});


