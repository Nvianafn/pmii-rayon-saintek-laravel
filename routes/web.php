<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\BiroController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KaryaController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\KepengurusanController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PublicController;
use App\Livewire\KaryaIndex;
use App\Livewire\KegiatanIndex;
use App\Livewire\KepengurusanPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('tentang');

Route::get('/biro', [PublicController::class, 'biroIndex'])->name('biro.index');
Route::get('/biro/{biro}', [PublicController::class, 'biroShow'])->name('biro.show');

// Interactive pages (Livewire full-page components)
Route::get('/kepengurusan', KepengurusanPage::class)->name('kepengurusan');
Route::get('/kegiatan', KegiatanIndex::class)->name('kegiatan.index');
Route::get('/karya', KaryaIndex::class)->name('karya.index');

Route::get('/kegiatan/{kegiatan}', [PublicController::class, 'kegiatanShow'])->name('kegiatan.show');
Route::get('/karya/{karya}', [PublicController::class, 'karyaShow'])->name('karya.show');

Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PublicController::class, 'kontakSubmit'])->name('kontak.submit');

/*
|--------------------------------------------------------------------------
| Admin routes (auth + role gated)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:super_admin,admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('kegiatan', KegiatanController::class)->except(['show']);
        Route::resource('karya', KaryaController::class)->except(['show']);
        Route::resource('anggota', AnggotaController::class)->except(['show'])->parameters(['anggota' => 'anggota']);
        Route::resource('biro', BiroController::class)->except(['show'])->parameters(['biro' => 'biro']);
        Route::resource('periode', PeriodeController::class)->except(['show'])->parameters(['periode' => 'periode']);
        Route::resource('kepengurusan', KepengurusanController::class)->except(['show'])->parameters(['kepengurusan' => 'kepengurusan']);

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        // Super admin only
        Route::middleware('role:super_admin')->group(function () {
            Route::resource('users', UserController::class)->except(['show']);
        });
    });

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}
