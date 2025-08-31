<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;

// Form Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Form Dashboard Admin
Route::get('/dashboard_admin', function () {
    return view('dashboard_admin');
});

// Form Bidang rehsos
// Halaman form + data pengaduan
Route::get('/rehsos', [PengaduanController::class, 'rehsos'])->name('pengaduan.index');

// Halaman ppkg
Route::get('/ppkg', [PengaduanController::class, 'ppkg'])->name('ppkg.index');

// Halaman linjamsos
Route::get('/linjamsos', [PengaduanController::class, 'linjamsos'])->name('linjamsos.index');

// Halaman dayasos
Route::get('/dayasos', [PengaduanController::class, 'dayasos'])->name('dayasos.index');

// Form Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Proses Login (sementara statis)
Route::post('/login', function (\Illuminate\Http\Request $request) {
    $username = $request->username;
    $password = $request->password;

    // contoh sederhana: cek statis dulu
    if ($username === 'admin' && $password === '12345') {
        return redirect('/dashboard_admin');
    }

    return back()->with('error', 'Username atau Password salah!');
});

// Proses simpan pengaduan
Route::get('/pengaduan', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

// Proses tampil pengaduan
Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');

// Proses hapus pengaduan
Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

// Proses update status dikirim menjadi verifikasi
Route::put('/pengaduan/{id}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');

// Halaman tindak lanjut
Route::get('/pengaduan/{id}/proses', [PengaduanController::class, 'proses'])->name('pengaduan.proses');

// Update tindak lanjut (status tetap diproses)
Route::put('/pengaduan/{id}/update-proses', [PengaduanController::class, 'updateProses'])->name('pengaduan.updateProses');

// Selesaikan aduan
Route::put('/pengaduan/{id}/selesai', [PengaduanController::class, 'selesai'])->name('pengaduan.selesai');

// Update keterangan tindak lanjut
Route::put('/pengaduan/{id}/update-status', [PengaduanController::class, 'updateStatus'])
    ->name('pengaduan.updateStatus');

// proses lacak
Route::get('/cek-status/{id}', [PengaduanController::class, 'cekStatus'])->name('pengaduan.cekStatus');

//progres
Route::get('/dashboard_admin', [PengaduanController::class, 'dashboard'])->name('admin.dashboard');










