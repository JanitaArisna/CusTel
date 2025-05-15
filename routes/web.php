<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatinController;
use App\Http\Controllers\NonDatinController;
use App\Http\Controllers\AccountManagerController;
use App\Http\Controllers\Datin\BillDatinController;
use App\Http\Controllers\Datin\BillDatinIndexController;
use App\Http\Controllers\NonDatin\NonDatinAssetsController;
use App\Http\Controllers\NonDatin\NonDatinBillController;
use App\Http\Controllers\Datin\AssetsDatinController;
use App\Http\Controllers\koneksi;

use App\Http\Controllers\DashboardController;
use Illuminate\Routing\Router;

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


/* KHUSUS UNTUK DATIN DAN DATIN/ASSETS CONTROLLER NYA DatinController -------------------------------------------------------------- */
Route::prefix('datin')->name('datin.')->group(function () {
    Route::get('/', [DatinController::class, 'index'])->name('index'); // Menampilkan daftar datin
    Route::get('/create', [DatinController::class, 'create'])->name('create'); // Form tambah
    Route::post('/store', [DatinController::class, 'store'])->name('store'); // Simpan data
});

Route::prefix('datin/{acc_num}/assets')->name('assets.')->group(function () {
    Route::get('/', [DatinController::class, 'show'])->name('show'); // Menampilkan daftar assets
    Route::get('/{sid}/edit', [DatinController::class, 'edit'])->name('edit'); // Form edit
    Route::put('/{sid}', [DatinController::class, 'update'])->name('update'); // Update data
    Route::delete('/{sid}', [DatinController::class, 'destroy'])->name('destroy'); // Hapus data
});
/* KHUSUS UNTUK DATIN DAN DATIN/ASSETS CONTROLLER NYA DatinController -------------------------------------------------------------- */


/* KHUSUS UNTUK DATIN BILL CONTROLLER NYA BillDatinController -------------------------------------------------------------- */
Route::get('datin/{acc_num}/bill', [BillDatinController::class, 'index'])->name('bill.index');

Route::prefix('datin/{acc_num}/bill')->name('bill.')->group(function () {
    Route::get('/{sid}/create', [BillDatinController::class, 'create'])->name('create'); // Form tambah
    Route::post('/{sid}/store', [BillDatinController::class, 'store'])->name('store'); // Simpan data
    Route::get('/{sid}', [BillDatinController::class, 'show'])->name('show'); // Menampilkan detail bill
    Route::get('/{sid}/{tahun}/edit', [BillDatinController::class, 'edit'])->name('edit'); // Form edit
    Route::put('/{sid}/{tahun}/update', [BillDatinController::class, 'update'])->name('update'); // Update data
    Route::delete('/{sid}/{tahun}', [BillDatinController::class, 'destroy'])->name('destroy'); // Hapus data
});
/* KHUSUS UNTUK DATIN BILL CONTROLLER NYA BillDatinController -------------------------------------------------------------- */



/* KHUSUS UNTUK NON DATIN/ASSET CONTROLLER NYA NonDatinController -------------------------------------------------------------- */
Route::prefix('non-datin')->name('non-datin.')->group(function () { 
    Route::get('/', [NonDatinController::class, 'index'])->name('index'); 
    Route::get('/create', [NonDatinController::class, 'create'])->name('create'); 
    Route::post('/store', [NonDatinController::class, 'store'])->name('store');     
});


Route::prefix('non-datin/{cca}/assets')->name('nonassets.')->group(function () {
    Route::get('/', [NonDatinController::class, 'show'])->name('show');
    Route::get('/{snd}/edit', [NonDatinController::class, 'edit'])->name('edit');
    Route::put('/{snd}', [NonDatinController::class, 'update'])->name('update');
    Route::delete('/{snd}', [NonDatinController::class, 'destroy'])->name('destroy');
});
/* KHUSUS UNTUK NON DATIN/ ASSET CONTROLLER NYA NonDatinController -------------------------------------------------- */


/* KHUSUS UNTUK NON DATIN Bill CONTROLLER NYA NonDatinBillController -------------------------------------------------- */
Route::get('non-datin/{cca}/bill', [NonDatinBillController::class, 'index'])->name('nonbill.index');

Route::prefix('non-datin/{cca}/bill')->name('nonbill.')->group(function () {
    Route::get('/{snd}', [NonDatinBillController::class, 'show'])->name('show');
    Route::get('/{snd}/create', [NonDatinBillController::class, 'create'])->name('create');
    Route::post('/{snd}', [NonDatinBillController::class, 'store'])->name('store');
    Route::get('/{snd}/{tahun}/edit', [NonDatinBillController::class, 'edit'])->name('edit');
    Route::put('/{snd}/{tahun}', [NonDatinBillController::class, 'update'])->name('update');
    Route::delete('/{snd}/{tahun}', [NonDatinBillController::class, 'destroy'])->name('destroy');
});
/* KHUSUS UNTUK NON DATIN Bill CONTROLLER NYA NonDatinBillController -------------------------------------------------- */


//Route::get('/datin', [DatinController::class, 'index'])->name('datin');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/non-datin', [NonDatinController::class, 'index'])->name('non-datin');

/* KHUSUS UNTUK ACCOUNT MANAGER CONTROLLER NYA AccountManagerController -------------------------------------------------- */
Route::prefix('account-manager')->group(function () {
    Route::get('/', [AccountManagerController::class, 'index'])->name('account-manager');
    Route::get('/business-service', [AccountManagerController::class, 'business'])->name('business');
        Route::get('/business-service/{dataBusiness}/detail', [AccountManagerController::class, 'showBusiness'])->name('showBusiness');
    Route::get('/government-service', [AccountManagerController::class, 'government'])->name('government');
        Route::get('/government-service/{dataGovernment}/detail', [AccountManagerController::class, 'showGovernment'])->name('showGovernment');
    Route::get('/enterprise-service', [AccountManagerController::class, 'enterprise'])->name('enterprise');
        Route::get('/enterprise-service/{dataEnterprise}/detail', [AccountManagerController::class, 'showEnterprise'])->name('showEnterprise');
});
/* KHUSUS UNTUK ACCOUNT MANAGER CONTROLLER NYA AccountManagerController -------------------------------------------------- */


//Route::get('/datin/{acc_num}/bill/{sid}/create', [BillDatinController::class, 'create']);
//Route::post('/datin/{acc_num}/bill/{sid}', [BillDatinController::class, 'store']);
//Route::get('/datin/{acc_num}/bill/{sid}/{id}', [BillDatinController::class, 'show']);
//Route::get('/datin/{acc_num}/bill/{sid}/{id}/edit', [BillDatinController::class, 'edit']);
//Route::put('/datin/{acc_num}/bill/{sid}/{id}', [BillDatinController::class, 'update']);
//Route::delete('/datin/{acc_num}/bill/{sid}/{id}', [BillDatinController::class, 'destroy']);





require __DIR__ . '/auth.php';