<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;

//post
Route::post('/register', [AuthController::Class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');


//get
Route::get('/logout', [AuthController::Class, 'logout'])->middleware('auth:api')->name('logout');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:api')->name('user');
Route::get('/email-verify/{id}', [AuthController::class, 'emailVerification'])->name('email_verified');

Route::get('/user/export-csv', [ExportController::class, 'exportCSV'])->middleware('auth:api')->name('export_csv');
Route::get('/user/export-csv2', [ExportController::class, 'exportCSV2'])->middleware('auth:api')->name('export_csv2');
Route::get('/user/export-pdf', [ExportController::class, 'exportPDF'])->middleware('auth:api')->name('export_pdf');

Route::get('/user/contract', [Controller::class, 'userContract'])->middleware('auth:api')->name('user_contract');



