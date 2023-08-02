<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'barang' => BarangController::class,
    'kategori' => KategoriController::class
]);

Route::post('/login',[AuthController::class,"login"]);
Route::post('/logout',[AuthController::class,"logout"]);
