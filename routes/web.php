<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjecteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('projectes', ProjecteController::class)->middleware('auth');
Route::patch('/projectes/{projecte}/canviar-estat', [ProjecteController::class, 'canviarEstat'])->name('projectes.canviarEstat')->middleware('auth');

Route::resource('clients', ClientController::class)->middleware('auth');
Route::get('/clients/{client}/projectes', [ClientController::class, 'projectes'])->name('clients.projectes')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
