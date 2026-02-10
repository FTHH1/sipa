<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users\Index;
use App\Livewire\Admin\Users\CreateUser;
use App\Livewire\Admin\Users\EditUser;
use App\Livewire\Admin\ActivityLogPage;


Route::get('/', fn () => view('welcome'))->name('home');

Route::middleware('auth')->group(function () {



    // Satu dashboard untuk semua role
    Route::get('/dashboard', fn () => view('dashboard'))    
        ->name('dashboard');

    // Optional alias khusus admin (redirect saja)

        Route::get('/users', Index::class)
            ->name('admin.users.index');

        Route::get('/users/create', CreateUser::class)
            ->name('admin.users.create');

         Route::get('/users/{user}/edit', EditUser::class)
            ->name('admin.users.edit');

         Route::get('/logs', ActivityLogPage::class)
             ->name('admin.logs');



});

require __DIR__.'/settings.php';
    