<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatinController;
use App\Http\Controllers\NonDatinController;
use App\Http\Controllers\AccountManagerController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login'); // Redirect ke halaman login
});

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index']); // Setelah logout,  akan otomatis diarahkan kembali ke halaman login


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/datin', [DatinController::class, 'index'])->name('datin');
Route::get('/non-datin', [NonDatinController::class, 'index'])->name('non-datin');
Route::get('/account-manager', [AccountManagerController::class, 'index'])->name('account-manager');

require __DIR__ . '/auth.php';