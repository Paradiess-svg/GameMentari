<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/1stgrade/1', function () {
        return view('quiz/1st_grade/1');
    })->name('1stgrade-1');
    Route::get('/1stgrade/2', function () {
        return view('quiz/1st_grade/2');
    })->name('1stgrade-2');

    Route::get('/2ndgrade/1', function () {
        return view('quiz/2nd_grade/1');
    })->name('2ndgrade-1');
    Route::get('/2ndgrade/2', function () {
        return view('quiz/2nd_grade/2');
    })->name('2ndgrade-2');
    Route::get('/2ndgrade/3', function () {
        return view('quiz/2nd_grade/3');
    })->name('2ndgrade-3');

    Route::get('/3rdgrade/1', function () {
        return view('quiz/3rd_grade/1');
    })->name('3rdgrade-1');
    Route::get('/3rdgrade/2', function () {
        return view('quiz/3rd_grade/2');
    })->name('3rdgrade-2');

    Route::post('/update-score', [GameController::class, 'updateScore'])->name('update-score');
    Route::post('/save-time', [GameController::class, 'saveTime'])->name('save-time');
    Route::get('/leaderboard', [GameController::class, 'showLeaderboard'])->name('leaderboard');
});

require __DIR__.'/auth.php';
