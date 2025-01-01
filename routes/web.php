<?php

use App\Http\Controllers\AgreementPPDBController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifyFormulirPPDBController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenagaPendidikController;
use App\Http\Controllers\PeriodePPDBController;
use App\Http\Controllers\BendaharaPPDBController;
use App\Http\Controllers\PanitiaPPDBController;
use App\Http\Controllers\FormPendaftarController;
use App\Http\Controllers\InformasiPembayaranController;
use App\Http\Controllers\OrientasiController;
use App\Http\Controllers\StatusPendaftaranController;
use App\Http\Controllers\VerifyPaymentController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// kepsek
Route::middleware(['auth', 'verified', 'role:kepsek'])->group(function () {
    Route::resource('tenaga-pendidik', TenagaPendidikController::class);
    Route::resource('periode-ppdb', PeriodePPDBController::class);
    Route::resource('panitia-ppdb', PanitiaPPDBController::class);
    Route::resource('bendahara-ppdb', BendaharaPPDBController::class);
});

// pendaftar
Route::middleware(['auth', 'verified', 'role:pendaftar,guru,kepsek'])->group(function () {
    Route::get('/formulir-ppdb/data-pendaftar', [FormPendaftarController::class, 'dataPendaftar'])->name('formulir-ppdb.dataPendaftar');
    Route::post('/formulir-ppdb/data-pendaftar', [FormPendaftarController::class, 'storeDataPendaftar'])->name('formulir-ppdb.storeDataPendaftar');

    Route::get('/formulir-ppdb/dokumen-pendaftar', [FormPendaftarController::class, 'dokumenPendaftar'])->name('formulir-ppdb.dokumenPendaftar');
    Route::post('/formulir-ppdb/dokumen-pendaftar', [FormPendaftarController::class, 'storeDokumenPendaftar'])->name('formulir-ppdb.storeDokumenPendaftar');

    Route::get('/formulir-ppdb/data-orang-tua', [FormPendaftarController::class, 'dataOrangTua'])->name('formulir-ppdb.dataOrangTua');
    Route::post('/formulir-ppdb/data-orang-tua', [FormPendaftarController::class, 'storeDataOrangTua'])->name('formulir-ppdb.storeDataOrangTua');

    Route::get('/formulir-ppdb/dokumen-orang-tua', [FormPendaftarController::class, 'dokumenOrangTua'])->name('formulir-ppdb.dokumenOrangTua');
    Route::post('/formulir-ppdb/dokumen-orang-tua', [FormPendaftarController::class, 'storeDokumenOrangTua'])->name('formulir-ppdb.storeDokumenOrangTua');

    Route::get('/formulir-ppdb/pembayaran', [FormPendaftarController::class, 'pembayaran'])->name('formulir-ppdb.pembayaran');
    Route::post('/formulir-ppdb/pembayaran', [FormPendaftarController::class, 'storePembayaran'])->name('formulir-ppdb.storePembayaran');

    Route::post('/formulir-ppdb/kirim', [FormPendaftarController::class, 'kirimFormulir'])->name('formulir-ppdb.kirimFormulir');
    Route::get('/status-pendaftaran', [StatusPendaftaranController::class, 'index'])->name('status-pendaftaran.index');
});

// bendahara
Route::middleware(['auth', 'verified', 'role:bendahara'])->group(function () {
    Route::get('/informasi-pembayaran', [InformasiPembayaranController::class, 'index'])->name('informasi-pembayaran.index');
    Route::post('/informasi-pembayaran', [InformasiPembayaranController::class, 'store'])->name('informasi-pembayaran.store');
    Route::post('/informasi-pembayaran/{id}', [InformasiPembayaranController::class, 'show'])->name('informasi-pembayaran.show');
    
    Route::get('/verify-payment', [VerifyPaymentController::class, 'index'])->name('verify-payment.index');
    Route::post('/verify-payment/verify/{id}', [VerifyPaymentController::class, 'verify'])->name('verify-payment.verify');
    Route::post('/verify-payment/reject/{id}', [VerifyPaymentController::class, 'reject'])->name('verify-payment.reject');
});

// panitia
Route::middleware(['auth', 'verified', 'role:panitia'])->group(function () {
    Route::get('/agreement', [AgreementPPDBController::class, 'index'])->name('agreement.index');
    Route::post('/agreement', [AgreementPPDBController::class, 'store'])->name('agreement.store');
    Route::post('/agreement/{id}', [AgreementPPDBController::class, 'show'])->name('agreement.show');

    Route::get('/orientasi', [OrientasiController::class, 'index'])->name('orientasi.index');
    Route::get('/orientasi/create', [OrientasiController::class, 'create'])->name('orientasi.create');
    Route::post('/orientasi', [OrientasiController::class, 'store'])->name('orientasi.store');
    Route::get('/orientasi/{id}', [OrientasiController::class, 'edit'])->name('orientasi.edit');
    Route::put('/orientasi/{id}', [OrientasiController::class, 'update'])->name('orientasi.update');
    Route::delete('/orientasi/{id}', [OrientasiController::class, 'delete'])->name('orientasi.delete');

    Route::get('/verify-formulir', [VerifyFormulirPPDBController::class, 'index'])->name('verify-formulir.index');
    Route::post('/verify-formulir/verify/{id}', [VerifyFormulirPPDBController::class, 'verify'])->name('verify-formulir.verify');
    Route::post('/verify-formulir/reject/{id}', [VerifyFormulirPPDBController::class, 'reject'])->name('verify-formulir.reject');
});


require __DIR__ . '/auth.php';
