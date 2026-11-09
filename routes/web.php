<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\MatakuliahController;
use App\Http\Controllers\Auth\AutoLoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rute 1: Home
Route::get('/', [ProfileController::class, 'home'])->name('home');

// Rute 3: Ide Platform Agentic AI (parameter opsional)
Route::get('/agent/{tema?}', [ProfileController::class, 'agentIdea'])->name('agent.idea');

// Tantangan 2: Kalkulator IPK
Route::get('/hitung-ipk/{ip1}/{ip2}', [ProfileController::class, 'hitungIpk'])
    ->where(['ip1' => '[0-9]+(\.[0-9]+)?', 'ip2' => '[0-9]+(\.[0-9]+)?'])
    ->name('ipk.hitung');

// Tantangan 3: Grouping rute profil akademis di bawah prefix /dashboard
Route::prefix('/dashboard')->name('dashboard.')->group(function () {

    // Rute 2 + Tantangan 1: Detail Profil dengan regex NRP 10 digit
    Route::get('/mahasiswa/{nrp}', [ProfileController::class, 'showMahasiswa'])
        ->where('nrp', '[0-9]{10}')
        ->name('mahasiswa.detail');

    Route::get('/riwayat-studi', [ProfileController::class, 'riwayatStudi'])
        ->name('riwayat');
});


Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('users', UserController::class)
            ->middleware('permission:manage users');

        Route::resource('mahasiswa', MahasiswaController::class)
            ->middleware('permission:manage mahasiswa');

        Route::resource('matakuliah', MatakuliahController::class)
            ->middleware('permission:manage matakuliah');
    });

// Auto‑login demo route (guest only)
Route::get('autologin/{email}', AutoLoginController::class)
    ->name('autologin')
    ->middleware('guest');

// Tantangan 3: Fallback route
Route::fallback(function () {
    return response()->view('errors.fallback', [], 404);
});