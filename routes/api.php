<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/user/search', [App\Http\Controllers\UserController::class, 'searchByName'])->name('searchUserByName');
Route::get('/user/searchGuru', [App\Http\Controllers\UserController::class, 'searchGuruByName'])->name('searchGuruByName');

Route::post('/penentuan-panitia-bendahara', [App\Http\Controllers\PanitiaBendaharaPeriodePPDBController::class, 'store'])->name('penentuan-panitia-bendahara.store');