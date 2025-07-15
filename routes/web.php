<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\LaporanAbsensiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengajuanIzinController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Pegawai;

// ======= LOGIN / LOGOUT =======

// Form login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ======= DEFAULT REDIRECT =======

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});


// ======= ROUTE SETELAH LOGIN =======

Route::middleware(['auth'])->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Admin
    Route::middleware('check.role:admin')->group(function () {
        Route::get('/admin', fn() => view('admin.index'))->name('admin.index');
    });

    // HRD
    Route::middleware('check.role:hrd')->group(function () {
        Route::get('/hrd', fn() => view('hrd.index'))->name('hrd.index');
    });

    // Keuangan
    Route::middleware('check.role:keuangan')->group(function () {
        Route::get('/keuangan', fn() => view('keuangan.index'))->name('keuangan.index');
    });

    // Manajer / Kepala Sekolah
    Route::middleware('check.role:manager')->group(function () {
        Route::get('/manager', fn() => view('manager.index'))->name('manager.index');
    });

    // Pegawai (tetap, magang, outsourcing)
    Route::middleware('check.role:pegawai')->group(function () {
        Route::get('/pegawai', fn() => view('pegawai.index'))->name('pegawai.index');
    });
});

// Route::resource('users', UserController::class)->middleware('check.role:admin')->name('users');
Route::resource('users', UserController::class)
    ->middleware('check.role:admin')
    ->names([
        'index' => 'pages.users.index',
        'create' => 'pages.users.create',
        'store' => 'pages.users.store',
        'edit' => 'pages.users.edit',
        'update' => 'pages.users.update',
        'destroy' => 'pages.users.destroy',
        'show' => 'pages.users.show',
    ]);
// Route::resource('pegawai', PegawaiController::class)->middleware('check.role:admin,hrd')->name('pegawai.index');
// Route::resource('jabatan', RoleController::class)->middleware('check.role:admin,hrd');
Route::resource('roles', RoleController::class)
    ->middleware('check.role:admin')
    ->names([
        'index' => 'pages.roles.index',
        'create' => 'pages.roles.create',
        'store' => 'pages.roles.store',
        'edit' => 'pages.roles.edit',
        'update' => 'pages.roles.update',
        'destroy' => 'pages.roles.destroy',
        'show' => 'pages.roles.show',
    ]);
Route::middleware('check.role:admin,hrd')->group(function () {
    Route::resource('pegawai', PegawaiController::class)->names([
        'index'   => 'pages.pegawai.index',
        'create'  => 'pages.pegawai.create',
        'store'   => 'pages.pegawai.store',
        'show'    => 'pages.pegawai.show',
        'edit'    => 'pages.pegawai.edit',
        'update'  => 'pages.pegawai.update',
        'destroy' => 'pages.pegawai.destroy',
    ]);
});
Route::middleware('check.role:admin,hrd,pegawai')->group(function () {
    Route::resource('absensi', AbsensiController::class)->names([
        'index'   => 'pages.absensi.index',
        'create'  => 'pages.absensi.create',
        'store'   => 'pages.absensi.store',
        'show'    => 'pages.absensi.show',
        'edit'    => 'pages.absensi.edit',
        'update'  => 'pages.absensi.update',
        'destroy' => 'pages.absensi.destroy',
    ]);

    Route::get('/pages/absensi/create-login', [AbsensiController::class, 'createByLogin'])->name('pages.absensi.create-login');
    Route::post('/pages/absensi/store-login', [AbsensiController::class, 'storeByLogin'])->name('pages.absensi.store-login');
    Route::post('/pages/absensi/store-pulang', [AbsensiController::class, 'storeJamPulang'])->name('pages.absensi.store-pulang');
});


Route::middleware(['auth', 'check.role:pegawai,admin,hrd,keuangan,manager'])->group(function () {
    Route::get('/pengajuan-izin', [PengajuanIzinController::class, 'index'])->name('pages.pengajuan-izin.index');
    Route::get('/pengajuan-izin/create', [PengajuanIzinController::class, 'create'])->name('pages.pengajuan-izin.create');
    Route::post('/pengajuan-izin', [PengajuanIzinController::class, 'store'])->name('pages.pengajuan-izin.store');
});

Route::middleware(['auth', 'check.role:admin,hrd'])->group(function () {
    Route::get('/pengajuan-izin/data', [PengajuanIzinController::class, 'data'])->name('pages.pengajuan-izin.data');
    Route::put('/pengajuan-izin/{id}/approve', [PengajuanIzinController::class, 'approve'])->name('pages.pengajuan-izin.approve');
    Route::put('/pengajuan-izin/{id}/reject', [PengajuanIzinController::class, 'reject'])->name('pages.pengajuan-izin.reject');
});

Route::middleware(['auth', 'check.role:admin,hrd,keuangan'])->group(function () {
    Route::get('/laporan-absensi', [LaporanAbsensiController::class, 'index'])->name('pages.laporan-absensi.index');
    Route::get('/laporan-absensi/cetak', [LaporanAbsensiController::class, 'cetak'])->name('pages.laporan-absensi.cetak');
});
