<?php

use App\Livewire\AlatMusik\AlatIndex;
use App\Livewire\Kategori\KategoriIndex;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users\Index;
use App\Livewire\Admin\Users\CreateUser;
use App\Livewire\Admin\Users\EditUser;
use App\Livewire\Admin\ActivityLogPage;
use App\Livewire\Peminjaman\PeminjamanIndex;

Route::middleware(['auth'])->group(function () {

    // ================= USERS =================
    Route::prefix('users')->name('admin.users.')->group(function () {

        Route::get('/', Index::class)->name('index');
        Route::get('/create', CreateUser::class)->name('create');
        Route::get('/{user}/edit', EditUser::class)->name('edit');

    });


    // ================= ALAT MUSIK =================
    Route::get('/alat-musik', AlatIndex::class)
        ->name('alat-musik.index');


    // ================= KATEGORI =================
    Route::get('/kategori', KategoriIndex::class)
        ->name('kategori.index');


    // ================= DASHBOARD =================
    Route::get('/dashboard', Dashboard::class)
        ->name('dashboard');


    // ================= LOG =================
    Route::get('/logs', ActivityLogPage::class)
        ->name('admin.logs');

        // ================= Peminjaman =================
     Route::get('/peminjaman', PeminjamanIndex::class)
    ->name('peminjaman.index');

});


require __DIR__.'/settings.php';
