<?php

use Illuminate\Support\Facades\Route;

Route::get('/homepage', function () {
    return view('homepage.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
