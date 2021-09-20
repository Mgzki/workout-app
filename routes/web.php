<?php

use App\Http\Controllers\TimerController;
use App\Models\Timer;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'guestTimer' => Timer::first(),
    ]);
});

Route::get('/dashboard', [TimerController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/dashboard', [TimerController::class, 'store'])->middleware(['auth', 'verified'])->name('timer.store');
Route::patch('/dashboard/{timer}', [TimerController::class, 'update'])->middleware(['auth', 'verified'])->name('timer.update');
Route::delete('/dashboard/{timer}', [TimerController::class, 'destroy'])->middleware(['auth', 'verified'])->name('timer.delete');

require __DIR__.'/auth.php';
