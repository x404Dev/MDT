<?php

use App\Http\Controllers\DossiersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportsController;
use App\Http\Controllers\MandatsController;
use App\Http\Controllers\ChargesController;
use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return redirect('/');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('dossiers', DossiersController::class);
    Route::resource('mandats', MandatsController::class);
    

    Route::resource('dossiers.rapports', RapportsController::class)->shallow();
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('charges', ChargesController::class);
});

require __DIR__ . '/auth.php';
