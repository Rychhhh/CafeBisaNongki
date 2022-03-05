<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Route\RouteController;

/*
| Web Routes
*/

require __DIR__.'/auth.php';

// Free View
Route::get('/', function () {
    return view('welcome');
});


// View With Auth
Route::middleware('auth')->group(function() {
        
    Route::get('dashboard', [RouteController::class, 'dashboard'])->name('dashboard');
    
    // kasir
    Route::get('transaksi', [RouteController::class, 'transaksi'])->middleware('CheckRole:kasir');

    // manager
    Route::middleware('CheckRole:manager')->group(function () {
        // menu system
        Route::resource('menu', MenuController::class); //index, create,edit,delete
        
        Route::get('filter-laporan', [LaporanController::class, 'index']);
        Route::get('filter-laporan/{tglawal}/{tglakhir}', [LaporanController::class, 'showAll']);
        // cetak pdf
        Route::get('laporan/online_pdf', [LaporanController::class, 'onlinePdf']);
        Route::get('laporan/download_pdf', [LaporanController::class, 'downloadPdf']);
    });
   
    // admin
    Route::get('user', [RouteController::class, 'user'])->middleware('CheckRole:admin');

    // Profile

    Route::get('profile', [ProfileController::class, 'index']);
    Route::put('change-ava', [ProfileController::class, 'changeFotoProfile'])->name('change-ava');
    Route::put('change-prof', [ProfileController::class, 'changeDataProfile'])->name('change-prof');


});

