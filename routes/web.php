<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HttpRequestController;

Route::get('/', [HttpRequestController::class, 'index'])->name('http-requests.index');
Route::post('/search', [HttpRequestController::class, 'search'])->name('http-requests.search');
Route::post('/client-count', [HttpRequestController::class, 'getClientCount'])->name('http-requests.getClientCount');
Route::post('/status',[HttpRequestController::class,'getStatus']) -> name ('http-requests.getStatus');
