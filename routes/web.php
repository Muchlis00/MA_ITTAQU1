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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:kepsek'])->group(function () {
    Route::resource('tenaga-pendidik', TenagaPendidikController::class);
    Route::resource('periode-ppdb', PeriodePPDBController::class);
    Route::resource('panitia-ppdb', PanitiaPPDBController::class);
    Route::resource('bendahara-ppdb', BendaharaPPDBController::class);
});

Route::middleware(['auth', 'verified', 'role:pendaftar,guru,kepsek'])->group(function () {
    Route::get('/formulir-ppdb/data-pendaftar', [FormPendaftarController::class, 'dataPendaftar'])->name('formulir-ppdb.dataPendaftar');
    Route::post('/formulir-ppdb/data-pendaftar', [FormPendaftarController::class, 'storeDataPendaftar'])->name('formulir-ppdb.storeDataPendaftar');
    Route::get('/formulir-ppdb/data-orang-tua', [FormPendaftarController::class, 'dataOrangTua'])->name('formulir-ppdb.dataOrangTua');
    Route::post('/formulir-ppdb/data-orang-tua', [FormPendaftarController::class, 'storeDataOrangTua'])->name('formulir-ppdb.storeDataOrangTua');

});




require __DIR__ . '/auth.php';
