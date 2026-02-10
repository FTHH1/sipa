<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users\Index;
use App\Livewire\Admin\Users\CreateUser;
use App\Livewire\Admin\Users\EditUser;
use App\Http\Controllers\AlatMusikController;
use App\Livewire\Admin\ActivityLogPage;
use App\Livewire\Kategori\KategoriIndex;

Route::get('/', fn () => view('welcome'))->name('home');
Route::middleware('auth')->group(function () {

    Route::prefix('users')->name('admin.users.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/create', CreateUser::class)->name('create');
        Route::get('/{user}/edit', EditUser::class)->name('edit');

    });

      Route::get('/kategori', KategoriIndex::class)
        ->name('kategori.index');

    Route::resource('alat-musik', AlatMusikController::class)
        ->except('show');

Route::get('/dashboard', Dashboard::class)
    ->middleware('auth')
    ->name('dashboard');

    Route::get('/logs', ActivityLogPage::class)
        ->name('admin.logs')
        ->middleware(['auth']);
});

require __DIR__.'/settings.php';
