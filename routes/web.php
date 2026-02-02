<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Enseignant\EmploisDuTempsController;
use App\Http\Controllers\Enseignant\NoteController;
use App\Http\Controllers\Enseignant\EtudiantController;
use App\Http\Controllers\Enseignant\PresenceController;
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
    Route::get('/profile', function () {
        return Inertia::render('Profile');
        })->name('profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Notes
    Route::get('/enseignant/notes', [NoteController::class, 'index'])->name('enseignant.notes');
    Route::post('/enseignant/notes/{etudiant}', [NoteController::class, 'store'])->name('enseignant.notes.store');
    Route::put('/enseignant/notes/{note}', [NoteController::class, 'update'])->name('enseignant.notes.update');
    Route::delete('/enseignant/notes/{note}', [NoteController::class, 'destroy'])->name('enseignant.notes.destroy');

    // Étudiants
    Route::post('/enseignant/etudiants', [EtudiantController::class, 'store'])->name('enseignant.etudiants.store');
    Route::delete('/enseignant/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('enseignant.etudiants.destroy');

    // Présence
    Route::get('/enseignant/presence', [PresenceController::class, 'index'])->name('enseignant.presence');
    Route::post('/enseignant/presence', [PresenceController::class, 'store'])->name('enseignant.presence.store');

    // Emplois du temps
    Route::get('/enseignant/emplois-du-temps', [EmploisDuTempsController::class, 'index'])->name('enseignant.emplois-du-temps');
    Route::post('/enseignant/emplois-du-temps/enregistrer', [EmploisDuTempsController::class, 'store'])->name('enseignant.emplois-du-temps.store');
});

// Inscription personnalisée
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); 
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/enseignant/emplois-du-temps', function () {
     return Inertia::render('Enseignant/EmploisDuTemps'); 
     })->name('enseignant.emplois-du-temps');
require __DIR__.'/auth.php';
