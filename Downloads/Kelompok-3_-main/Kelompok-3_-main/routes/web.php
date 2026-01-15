<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PengabdianController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TPKController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'));

// LOGIN
Route::get('/login', [AuthController::class, 'pilihLogin'])->name('login');
Route::get('/login/pilih', [AuthController::class, 'pilihLogin'])->name('login.pilih');

Route::get('/login/admin', [AuthController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('login.admin.post');

Route::get('/login/dosen', [AuthController::class, 'showDosenLoginForm'])->name('login.dosen');
Route::post('/login/dosen', [AuthController::class, 'dosenLogin'])->name('login.dosen.post');

Route::get('/login/mahasiswa', [AuthController::class, 'showMahasiswaLoginForm'])->name('login.mahasiswa');
Route::post('/login/mahasiswa', [AuthController::class, 'mahasiswaLogin'])->name('login.mahasiswa.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| GOOGLE OAUTH
|--------------------------------------------------------------------------
*/
Route::get('/auth/google/redirect/{role?}', [GoogleController::class, 'redirect'])
    ->name('login.google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('login.google.callback');

Route::get('/auth/google/confirm-role', [GoogleController::class, 'confirmRole'])
    ->name('login.google.confirm_role');

Route::post('/auth/google/confirm-role/continue', [GoogleController::class, 'confirmRoleContinue'])
    ->name('login.google.confirm_role.continue');

Route::post('/auth/google/confirm-role/cancel', [GoogleController::class, 'confirmRoleCancel'])
    ->name('login.google.confirm_role.cancel');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');

    Route::get('/dosen/dashboard', fn () => redirect()->route('penelitian.index'))
        ->middleware('role:dosen')
        ->name('dosen.dashboard');

    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])
        ->middleware('role:mahasiswa')
        ->name('mahasiswa.dashboard');

    /*
    |--------------------------------------------------------------------------
    | DOSEN
    |--------------------------------------------------------------------------
    */
    Route::get('/dosen/export', [DosenController::class, 'export'])->name('dosen.export');
    Route::resource('dosen', DosenController::class);

    /*
    |--------------------------------------------------------------------------
    | PENELITIAN
    |--------------------------------------------------------------------------
    */
    Route::get('/penelitian/export', [PenelitianController::class, 'export'])->name('penelitian.export');
    Route::get('/penelitian/export.csv', [PenelitianController::class, 'exportCsv'])->name('penelitian.export.csv');
    Route::resource('penelitian', PenelitianController::class);

    /*
    |--------------------------------------------------------------------------
    | PENGABDIAN (RESOURCE UTAMA)
    |--------------------------------------------------------------------------
    */
    Route::get('/pengabdian/export', [PengabdianController::class, 'export'])->name('pengabdian.export');
    Route::get('/pengabdian/export.csv', [PengabdianController::class, 'exportCsv'])->name('pengabdian.export.csv');
    Route::resource('pengabdian', PengabdianController::class);

    /*
    |--------------------------------------------------------------------------
    | MAHASISWA
    |--------------------------------------------------------------------------
    */
    Route::resource('mahasiswa', MahasiswaController::class);

    Route::get('/mahasiswa/dokumentasi/{penelitian}/create',
        [MahasiswaController::class, 'createDokumentasi'])
        ->name('mahasiswa.dokumentasi.create');

    Route::post('/mahasiswa/dokumentasi/{penelitian}',
        [MahasiswaController::class, 'storeDokumentasi'])
        ->name('mahasiswa.dokumentasi.store');

    Route::get('/mahasiswa/dokumentasi-pengabdian/{pengabdian}/create',
        [MahasiswaController::class, 'createDokumentasiPengabdian'])
        ->name('mahasiswa.dokumentasi_pengabdian.create');

    Route::post('/mahasiswa/dokumentasi-pengabdian/{pengabdian}',
        [MahasiswaController::class, 'storeDokumentasiPengabdian'])
        ->name('mahasiswa.dokumentasi_pengabdian.store');

    /*
    |--------------------------------------------------------------------------
    | TPK (ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')
        ->prefix('admin/tpk')
        ->name('tpk.')
        ->group(function () {

            Route::get('/', [TPKController::class, 'index'])->name('index');
            Route::get('/export', [TPKController::class, 'exportCsv'])->name('export');

            Route::resource('alternatif', AlternatifController::class)->except('show');
            Route::resource('kriteria', KriteriaController::class)->except('show');

            Route::post('/kriteria/update-bobot',
                [KriteriaController::class, 'updateBobot'])
                ->name('kriteria.updateBobot');
        });

    /*
    |--------------------------------------------------------------------------
    | LEGACY PRESTASI (JANGAN DIUBAH)
    |--------------------------------------------------------------------------
    */
    Route::get('/prestasi', fn () => redirect()->route('tpk.index'))->name('prestasi.index');
    Route::get('/prestasi/create', fn () => redirect()->route('tpk.alternatif.create'))->name('prestasi.create');
    Route::post('/prestasi', fn () => redirect()->route('tpk.alternatif.index'))->name('prestasi.store');
    Route::get('/prestasi/{id}/edit', fn ($id) => redirect()->route('tpk.alternatif.edit', $id))->name('prestasi.edit');
    Route::put('/prestasi/{id}', fn ($id) => redirect()->route('tpk.alternatif.index'))->name('prestasi.update');
    Route::delete('/prestasi/{id}', fn ($id) => redirect()->route('tpk.alternatif.index'))->name('prestasi.destroy');
});
/*
|--------------------------------------------------------------------------
| ROUTE ALIAS (PENYELAMAT BLADE LAMA)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // ===== PLURAL (BLADE LAMA / DASHBOARD) =====
    Route::get('/pengabdian', [PengabdianController::class, 'index'])
        ->name('pengabdians.index');

    Route::get('/pengabdian/create', [PengabdianController::class, 'create'])
        ->name('pengabdians.create');

    Route::post('/pengabdian', [PengabdianController::class, 'store'])
        ->name('pengabdians.store');

    Route::get('/pengabdian/{pengabdian}/edit', [PengabdianController::class, 'edit'])
        ->name('pengabdians.edit');

    Route::put('/pengabdian/{pengabdian}', [PengabdianController::class, 'update'])
        ->name('pengabdians.update');

    Route::delete('/pengabdian/{pengabdian}', [PengabdianController::class, 'destroy'])
        ->name('pengabdians.destroy');
});

/*
|--------------------------------------------------------------------------
| FINAL PATCH – JANGAN DIHAPUS
|--------------------------------------------------------------------------
| Untuk blade BARU:
| route('pengabdian.store')
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // ===== SINGULAR (BLADE BARU) =====
    Route::post('/pengabdian', [PengabdianController::class, 'store'])
        ->name('pengabdian.store');

    Route::get('/pengabdian', [PengabdianController::class, 'index'])
        ->name('pengabdian.index');

    Route::get('/pengabdian/create', [PengabdianController::class, 'create'])
        ->name('pengabdian.create');

    Route::get('/pengabdian/{pengabdian}/edit', [PengabdianController::class, 'edit'])
        ->name('pengabdian.edit');

    Route::put('/pengabdian/{pengabdian}', [PengabdianController::class, 'update'])
        ->name('pengabdian.update');

    Route::delete('/pengabdian/{pengabdian}', [PengabdianController::class, 'destroy'])
        ->name('pengabdian.destroy');
        Route::get('/_pengabdian_fix', function () {
    return redirect()->route('pengabdian.index');
})->name('pengabdians.index');

/*
|--------------------------------------------------------------------------
| FINAL FIX – ALIAS PENGABDIAN CREATE
|--------------------------------------------------------------------------
| Menyelesaikan error:
| Route [pengabdians.create] not defined
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->get('/_pengabdian_create_fix', function () {
    return redirect()->route('pengabdian.create');
})->name('pengabdians.create');

});
