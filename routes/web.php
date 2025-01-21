<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesertaQrisController;

Route::get('/', [PesertaQrisController::class, 'index']);
Route::get('/peserta', [PesertaQrisController::class, 'index']);
Route::get('/top-event', [PesertaQrisController::class, 'topEvent']);
Route::get('/transaksi-per-bulan', [PesertaQrisController::class, 'transaksiPerBulan']);
Route::get('/usaha-count', [PesertaQrisController::class, 'usahaCount']);
