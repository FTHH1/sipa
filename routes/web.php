<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');

Route::middleware('auth')->group(function () {

    // Satu dashboard untuk semua role
    Route::get('/dashboard', fn () => view('dashboard'))
        ->name('dashboard');

    // Optional alias khusus admin (redirect saja)
    Route::get('/admin/dashboard', fn () => redirect()->route('dashboard'))
        ->middleware('role:admin')
        ->name('admin.dashboard');

});

require __DIR__.'/settings.php';
