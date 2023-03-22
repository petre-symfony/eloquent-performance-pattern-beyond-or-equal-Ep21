<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\CustomersController;
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

// Route::get('/', [UsersController::class, 'index']); Ep21
// Route::get('/', [DevicesController::class, 'index']); Ep23
// Route::get('/', [PostsController::class, 'index']); Ep24
// Route::get('/', [StoresController::class, 'index']); Ep25, 26, 27
Route::get('/', [CustomersController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
