<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ADMIN
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Users\Index;
use App\Livewire\Admin\Users\CreateUser;
use App\Livewire\Admin\Users\EditUser;
use App\Livewire\Admin\ActivityLogPage;

// PETUGAS
use App\Livewire\Petugas\Dashboard as PetugasDashboard;
use App\Livewire\Petugas\Monitoring;
use App\Livewire\Petugas\Laporan;
use App\Http\Controllers\LaporanController;

// UMUM
use App\Livewire\Peminjaman\PeminjamanIndex;
use App\Livewire\AlatMusik\AlatIndex;
use App\Livewire\Kategori\KategoriIndex;

/*
|--------------------------------------------------------------------------
| Redirect Awal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('home');
});


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {

        Route::get('/dashboard', AdminDashboard::class)
            ->name('dashboard');

        Route::prefix('users')->name('admin.users.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('/create', CreateUser::class)->name('create');
            Route::get('/{user}/edit', EditUser::class)->name('edit');
        });

        Route::get('/logs', ActivityLogPage::class)
            ->name('admin.logs');

    });


    /*
    |--------------------------------------------------------------------------
    | PETUGAS
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:petugas'])->group(function () {

        Route::get('/dashboard-petugas', PetugasDashboard::class)
            ->name('dashboard.petugas');

        Route::get('/monitoring', Monitoring::class)
            ->name('monitoring.index');

        Route::get('/laporan', Laporan::class)
            ->name('laporan.index');

        Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])
            ->name('laporan.cetak');
    });


    /*
    |--------------------------------------------------------------------------
    | UMUM (LOGIN SEMUA ROLE)
    |--------------------------------------------------------------------------
    */
    Route::get('/peminjaman', PeminjamanIndex::class)
        ->name('peminjaman.index');

    Route::get('/alat-musik', AlatIndex::class)
        ->name('alat-musik.index');

    Route::get('/kategori', KategoriIndex::class)
        ->name('kategori.index');
});


/*
|--------------------------------------------------------------------------
| HOME REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {

    if (!Auth::check()) {
        return redirect('/login');
    }

    $role = Auth::user()->role;

    return match ($role) {
        'admin'   => redirect()->route('dashboard'),
        'petugas' => redirect()->route('dashboard.petugas'),
        default   => redirect('/'),
    };

})->name('home');


require __DIR__.'/settings.php';
