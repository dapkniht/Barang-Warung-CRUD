<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){
    Route::resource('barang',BarangController::class);
    Route::resource('kategori',KategoriController::class);
});

Route::controller(AuthController::class)->name('auth.')->group(function(){
    Route::middleware('guest')->group(function (){
        Route::post('/login','login')->name('login');
        Route::get('/login','loginPage')->name('login-page');
        Route::get('/forgot-password','forgotPasswordPage')->name('forgot-password-page');
    });
    Route::get('/logout','logout')->name('logout')->middleware('auth');
});
