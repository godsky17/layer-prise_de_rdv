<?php

use App\Http\Controllers\RendezvousController;
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

Route::get('/', function () {
    return view('visiteur.index');
})->name('index');

Route::get('/rendez-vous', function () {
    return view('visiteur.form');
})->name('getrdv');

Route::post('/rendez-vous', [RendezvousController::class, 'store'])->name('saveRdv');


