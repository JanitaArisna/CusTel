<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatinController;
use App\Http\Controllers\NonDatinController;
use App\Http\Controllers\AccountManagerController;
use App\Http\Controllers\Datin\AssetsDatinController;
use App\Http\Controllers\Datin\BillDatinController;

use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login'); // Redirect ke halaman login
});

Route::middleware('auth')->group(function () {
    Route::get('/datin/create', [DatinController::class, 'create']);
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


Route::resource('datin', DatinController::class)->names([
    'index' => 'datin',
    'create' => 'datin.create',
    'store' => 'datin.store',
    'show' => 'datin.show',
    'edit' => 'datin.edit',
    'update' => 'datin.update',
    'destroy' => 'datin.destroy',
]);

Route::resource('datin/assets', AssetsDatinController::class)->names([
    'index' => 'datin.assets.index',
    'create' => 'datin.assets.create',
    'store' => 'datin.assets.store',
    'show' => 'datin.assets.show',
    'edit' => 'datin.assets.edit',
    'update' => 'datin.assets.update',
    'destroy' => 'datin.assets.destroy',
]);
Route::put('/datin/assets/{sid}', [AssetsDatinController::class, 'update'])->name('assets.update');
Route::delete('/datin/assets/{sid}', [AssetsDatinController::class, 'destroy'])->name('assets.destroy');



Route::prefix('datin/{acc_num}')->group(function () {
    Route::resource('bill', BillDatinController::class)
        ->names([
            'index' => 'bill.index',
            'create' => 'bill.create',
            'store' => 'bill.store',
            'show' => 'bill.show',
            'edit' => 'bill.edit',
            'update' => 'bill.update',
            'destroy' => 'bill.destroy',
        ]);
});

Route::get('/assets/{sid}/edit', [AssetsDatinController::class, 'edit'])->name('assets.edit');
Route::get('/datin/{acc_num}/assets', [AssetsDatinController::class, 'index'])->name('datin.assets.index');



Route::get('datin/{acc_num}/assets', [AssetsDatinController::class, 'showAssets']);
Route::get('datin/{acc_num}/bill', [BillDatinController::class, 'showBill']);
//Route::get('datin/{sid}/bill', [BillDatinController::class, 'showBill'])->name('bill');


//Route::get('/datin', [DatinController::class, 'index'])->name('datin');
Route::get('/non-datin', [NonDatinController::class, 'index'])->name('non-datin');
Route::get('/account-manager', [AccountManagerController::class, 'index'])->name('account-manager');

Route::get('/assets', [AssetsDatinController::class, 'index'])->name('assets');
Route::get('/bill', [BillDatinController::class, 'index'])->name('bill');

require __DIR__ . '/auth.php';