<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;


Route::post('/register', [AuthController::Class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::Class, 'logout'])->middleware('auth:api');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:api')->name('user');
Route::get('/user/exportCSV', [ExportController::class, 'exportCSV'])->middleware('auth:api');
Route::get('/user/exportPDF', [ExportController::class, 'exportPDF'])->middleware('auth:api');

