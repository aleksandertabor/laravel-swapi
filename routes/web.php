<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharactersController;

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
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::prefix('characters')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [CharactersController::class, 'index'])->name('characters');

    Route::get('/{id}', [CharactersController::class, 'show'])->name('characters.show');

    Route::patch('/{id}', [CharactersController::class, 'update'])->name('characters.update');
});

require __DIR__.'/auth.php';
