<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('siswa', SiswaController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('pelajaran', PelajaranController::class);
    Route::resource('jadwal', JadwalController::class);
});

require __DIR__.'/auth.php';

Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
Route::post('/guru/store', [GuruController::class, 'store'])->name('guru.store');
