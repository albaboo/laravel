<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComentariController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjecteController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:ADMIN,GESTOR'])->group(function () {
    Route::resource('projectes', ProjecteController::class)
        ->except(['index', 'show']);
    Route::resource('clients', ClientController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('projectes', ProjecteController::class)
        ->only(['index', 'show']);
});

Route::patch('/projectes/{projecte}/canviar-estat', [ProjecteController::class, 'canviarEstat'])->name('projectes.canviarEstat')->middleware(['auth', 'role:ADMIN,GESTOR']);

Route::resource('clients', ClientController::class)->middleware('auth')->middleware(['auth', 'role:ADMIN,GESTOR']);
Route::get('/clients/{client}/projectes', [ClientController::class, 'projectes'])->name('clients.projectes')->middleware(['auth', 'role:ADMIN,GESTOR']);

Route::middleware('auth')->prefix('projectes/{projecte}/tickets')->group(function () {
    Route::get('', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
});
Route::post('tickets/{ticket}/comentaris', [ComentariController::class, 'store'])->name('comentaris.store')->middleware('auth');
Route::delete('comentaris/{comentari}', [ComentariController::class, 'destroy'])->name('comentaris.destroy')->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
