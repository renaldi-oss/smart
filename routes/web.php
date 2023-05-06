<?php

use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('beranda');
})->name('beranda');
Route::get('login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('register', function () {
    return view('auth.register');
})->name('register');
Route::post('register', [UserController::class, 'register'])->name('register');
Route::middleware(['auth'])->group(function () {
    Route::resource('kriteria', KriteriaController::class)->except(['show']);
    Route::resource('parameter', ParameterController::class)->except(['show']);
    Route::resource('alternatif', AlternatifController::class)->except(['show']);
    Route::resource('nilai', NilaiController::class)->except(['show']);
    Route::get('perhitungan', [PerhitunganController::class, 'tampil'])->name('perhitungan.tampil');
    Route::get('perhitungan/cetak', [PerhitunganController::class, 'cetak'])->name('perhitungan.cetak');
});
