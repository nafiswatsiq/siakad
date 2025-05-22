<?php

use App\Http\Controllers\KhsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('filament.admin.auth.login');
});

Route::get('/khs/cetak/{id}', [KhsController::class, 'cetakKhs'])->name('khs.cetak');
