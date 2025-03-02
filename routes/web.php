<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatinController;
use App\Http\Controllers\NonDatinController;
use App\Http\Controllers\AccountManagerController;
use App\Http\Controllers\Datin\AssetsDatinController;
use App\Http\Controllers\Datin\BillDatinController;
use App\Http\Controllers\Datin\BillDatinIndexController;
use App\Http\Controllers\NonDatin\NonDatinAssetsController;
use App\Http\Controllers\NonDatin\NonDatinBillController;

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




/*Route::prefix('datin/{acc_num}')->group(function () {
    Route::resource('bill', BillDatinIndexController::class)
        ->names([
            'index' => 'bill.index',
        ]);
});

/*Route::prefix('datin/{sid}')->group(function () {
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
}); */


Route::get('/datin/assets/{sid}/edit', [AssetsDatinController::class, 'edit' ])->name('assets.edit');
//Route::get('datin/{acc_num}/assets/{sid}/edit', [DatinController::class, 'edit'])->name('assets.edit');
Route::get('/datin/{acc_num}/assets', [AssetsDatinController::class, 'index'])->name('datin.assets.index');


/* KHUSUS UNTUK HALAMAN DATIN YANG ROUTER KE ASSETS DAN BILL -------------------------------------------------------------- */
Route::get('datin/{acc_num}/assets', [AssetsDatinController::class, 'showAssets']);
Route::get('datin/{acc_num}/bill', [BillDatinIndexController::class, 'Billindex']);
//Route::get('datin/bill/{sid}', [BillDatinController::class, 'show'])->name('bill');
/* KHUSUS UNTUK HALAMAN DATIN YANG ROUTER KE ASSETS DAN BILL -------------------------------------------------------------- */

/* KHUSUS UNTUK DATIN BILL CONTROLLER NYA BillDatinController -------------------------------------------------------------- */
Route::prefix('datin/bill')->name('bill.')->group(function () {
    Route::get('/{sid}', [BillDatinController::class, 'index'])->name('index'); // Menampilkan daftar bill
    Route::get('/{sid}/create', [BillDatinController::class, 'create'])->name('create'); // Form tambah
    Route::post('/{sid}/store', [BillDatinController::class, 'store'])->name('store'); // Simpan data
    Route::get('/{sid}', [BillDatinController::class, 'show'])->name('show'); // Menampilkan detail bill
    Route::get('/{sid}/{tahun}/edit', [BillDatinController::class, 'edit'])->name('edit'); // Form edit
    Route::put('/{sid}/{tahun}/update', [BillDatinController::class, 'update'])->name('update'); // Update data
    Route::delete('/{sid}/{tahun}', [BillDatinController::class, 'destroy'])->name('destroy'); // Hapus data
});
/* KHUSUS UNTUK DATIN BILL CONTROLLER NYA BillDatinController -------------------------------------------------------------- */



/* KHUSUS UNTUK NON DATIN CONTROLLER NYA NonDatinController -------------------------------------------------------------- */
Route::prefix('non-datin')->name('non-datin.')->group(function () { 
    Route::get('/', [NonDatinController::class, 'index'])->name('index'); 
    Route::get('/create', [NonDatinController::class, 'create'])->name('create'); 
    Route::post('/store', [NonDatinController::class, 'store'])->name('store');     
});
/* KHUSUS UNTUK NON DATIN CONTROLLER NYA NonDatinController -------------------------------------------------------------- */



/* KHUSUS UNTUK NON DATIN ASSETS CONTROLLER NYA NonDatinAssetsController -------------------------------------------------- */
Route::prefix('non-datin/assets')->name('non-datin.assets.')->group(function () {
    Route::get('/{cca}', [NonDatinAssetsController::class, 'index'])->name('index');
    Route::get('/', [NonDatinAssetsController::class, 'show'])->name('show');
    Route::get('/{cca}/{snd}/edit', [NonDatinAssetsController::class, 'edit'])->name('edit');
    Route::put('/{cca}/{snd}', [NonDatinAssetsController::class, 'update'])->name('update');
    Route::delete('/{cca}/{snd}', [NonDatinAssetsController::class, 'destroy'])->name('destroy');
});
/* KHUSUS UNTUK NON DATIN ASSETS CONTROLLER NYA NonDatinAssetsController -------------------------------------------------- */



/* KHUSUS UNTUK NON DATIN ASSETS CONTROLLER NYA NonDatinBillController -------------------------------------------------- */


/* KHUSUS UNTUK NON DATIN ASSETS CONTROLLER NYA NonDatinBillController -------------------------------------------------- */




//Route::get('/datin/{acc_num}/bill/{sid}', [BillDatinController::class, 'showBill'])->name('bill.show');

//Route::get('datin/{acc_num}/bill/{sid}/{id}', [BillDatinController::class, 'show']);


//Route::get('/datin', [DatinController::class, 'index'])->name('datin');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/non-datin', [NonDatinController::class, 'index'])->name('non-datin');
Route::get('/account-manager', [AccountManagerController::class, 'index'])->name('account-manager');

Route::get('/assets', [AssetsDatinController::class, 'index'])->name('assets');
Route::get('/bill', [BillDatinController::class, 'index'])->name('bill');





//Route::get('/datin/{acc_num}/bill/{sid}/create', [BillDatinController::class, 'create']);
//Route::post('/datin/{acc_num}/bill/{sid}', [BillDatinController::class, 'store']);
//Route::get('/datin/{acc_num}/bill/{sid}/{id}', [BillDatinController::class, 'show']);
//Route::get('/datin/{acc_num}/bill/{sid}/{id}/edit', [BillDatinController::class, 'edit']);
//Route::put('/datin/{acc_num}/bill/{sid}/{id}', [BillDatinController::class, 'update']);
//Route::delete('/datin/{acc_num}/bill/{sid}/{id}', [BillDatinController::class, 'destroy']);



require __DIR__ . '/auth.php';