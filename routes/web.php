<?php

use App\Http\Controllers\MobilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Livewire\TransaksiComponent;
use App\Livewire\Customer\DetailTransaksi;
use App\Livewire\PembayaranComponent;
use App\Livewire\Customer\RiwayatTransaksi;
use App\Livewire\HomeComponent;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

// --- GUEST & CUSTOMER ---
Route::get('/', Home::class)->name('home');
// Route::get('/', [MobilController::class, 'publicIndex'])->name('home');


// --- AUTH ---
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses');
Route::post('logout', [LoginController::class, 'keluar'])->name('logout');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

// --- AUTH MIDDLEWARE GROUP ---
Route::middleware('auth')->group(function () {
    // Customer
    Route::get('/transaksi/{mobil}', TransaksiComponent::class)->name('transaksi.create');
    Route::get('/riwayat-transaksi', RiwayatTransaksi::class)->name('customer.riwayat');
    Route::get('/pembayaran/{id}', PembayaranComponent::class)->name('pembayaran.show');

    /*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [HomeController::class, 'index'])
        ->name('admin.dashboard');

    // Mobil & Users
    Route::get('mobil', [MobilController::class, 'index'])->name('mobil');
    Route::get('users', fn () => view('users.index'))->name('users');

    // LAPORAN (Pastikan ini unik)
    // Jika kamu punya Livewire Laporan, gunakan ini:
    Route::get('/admin/laporan-transaksi', App\Livewire\Admin\LaporanTransaksi::class)
        ->name('admin.laporan');
    
    // Jika kamu butuh route laporan biasa (halaman statis):
    Route::get('/admin/laporan-umum', fn () => view('laporan.index'))
        ->name('laporan'); 
});
});