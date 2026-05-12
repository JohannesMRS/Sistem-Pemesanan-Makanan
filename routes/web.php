<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;



Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/menu', [AdminController::class, 'menu'])->name('admin.menu');
Route::get('/transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');
Route::get('transaksi/detail/{id}', [AdminController::class, 'detailTransaksi'])->name('transaksi.detail');
Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');



Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/admin/dashboard', function() {
//     return "BERHASIL PINDAH HALAMAN!";
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/kasir/PointOfSales', [KasirController::class, 'index'])->name('kasir.PointOfSales');
    Route::post('transaksi/simpan', [KasirController::class, 'simpan'])->name('transaksi.simpan');
});


Route::post('/kasir/transaksi', [KasirController::class, 'transaksi'])->name('kasir.transaksi');
Route::post('/menu/simpan', [AdminController::class, 'store'])->name('admin.menu.store');

