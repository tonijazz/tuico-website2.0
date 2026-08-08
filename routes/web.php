<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/news', [NewsController::class, 'index']);
Route::prefix('sw')->group(function () {
    Route::get('/news', [NewsController::class, 'index']);
});
