<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VedaController;
use App\Http\Controllers\MahabharataController;
use App\Http\Controllers\PuranaController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\LeaderboardController;
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

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Vedas
Route::get('/vedas', [VedaController::class, 'index'])->name('vedas.index');
Route::get('/vedas/{veda}', [VedaController::class, 'show'])->name('vedas.show');
Route::get('/vedas/{veda}/mandala/{mandala}', [VedaController::class, 'showMandala'])->name('vedas.mandala');

// Mahabharata
Route::get('/mahabharata', [MahabharataController::class, 'index'])->name('mahabharata.index');
Route::get('/mahabharata/{parva}', [MahabharataController::class, 'show'])->name('mahabharata.show');
Route::get('/mahabharata/{parva}/chapter/{chapter}', [MahabharataController::class, 'showChapter'])->name('mahabharata.chapter');

// Puranas
Route::get('/puranas', [PuranaController::class, 'index'])->name('puranas.index');
Route::get('/puranas/{purana}', [PuranaController::class, 'show'])->name('puranas.show');

// Progress tracking (auth required)
Route::middleware('auth')->group(function () {
    Route::post('/verse/{verse}/mark-read', [ProgressController::class, 'markRead'])->name('verse.mark-read');
    Route::post('/verse/{verse}/mark-understood', [ProgressController::class, 'markUnderstood'])->name('verse.mark-understood');
    Route::post('/verse/{verse}/mark-memorized', [ProgressController::class, 'markMemorized'])->name('verse.mark-memorized');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
});
