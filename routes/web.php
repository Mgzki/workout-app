<?php

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
        'test' => Timer::first(),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'canLogin' => false,
        'canRegister' => false,
        'timers' => Auth::user()->timers()->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/{timer:name}', function (Timer $timer) {
    return Inertia::render('ShowTimer', [
        'canLogin' => false,
        'canRegister' => false,
        'timer' => $timer,
    ]);
})->middleware(['auth', 'verified'])->name('timer');

require __DIR__.'/auth.php';
