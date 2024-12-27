<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenagaPendidikController;
use App\Http\Controllers\PeriodePPDBController;
use App\Http\Controllers\BendaharaPPDBController;
use App\Http\Controllers\PanitiaPPDBController;
use App\Http\Controllers\FormPendaftarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::prefix('dashboard')->group(function () {
//     Route::get('/data-pendaftar', [FormPendaftarController::class, 'dataPendaftar'])->name('form-pendaftar.data-pendaftar');
//     Route::post('/data-pendaftar', [FormPendaftarController::class, 'storeDataPendaftar'])->name('form-pendaftar.store-data-pendaftar');
//     Route::get('/data-orang-tua', [FormPendaftarController::class, 'dataOrangTua'])->name('form-pendaftar.data-orang-tua');
//     Route::post('/data-orang-tua', [FormPendaftarController::class, 'storeDataOrangTua'])->name('form-pendaftar.store-data-orang-tua');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tenaga-pendidik', TenagaPendidikController::class);
    Route::resource('periode-ppdb', PeriodePPDBController::class);
    Route::resource('panitia-ppdb', PanitiaPPDBController::class);
    Route::resource('bendahara-ppdb', BendaharaPPDBController::class);
    Route::resource('formulir-ppdb', FormPendaftarController::class);

});

require __DIR__ . '/auth.php';
