<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicTacController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::redirect('/', '/register')->name('dashboard');
Route::redirect('/games', '/dashboard')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/games', GameController::class)->only(['index']);
    Route::group(['as' => 'games.'], function () {
        Route::resource('/games/tic-tac-toe', TicTacController::class)->only(['index', 'show', 'store', 'update']);
        Route::post('/games/tic-tac-toe/{tic_tac_toe}/join', [TicTacController::class, 'join'])->name('tic-tac-toe.join');
        Route::post('/games/tic-tac-toe/{tic_tac_toe}/rejoin', [TicTacController::class, 'rejoin'])->name('tic-tac-toe.rejoin');

    });
});

require __DIR__.'/auth.php';
