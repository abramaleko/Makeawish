<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::redirect('/', '/home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/requests', [App\Http\Controllers\HomeController::class, 'request'])->name('requests');

Route::post('/request/upload', [App\Http\Controllers\HomeController::class, 'Uploadrequest'])->name('upload-request');

Route::get('/request/grant/{id}',[App\Http\Controllers\HomeController::class, 'requestGrant'])->name('request-grant');
