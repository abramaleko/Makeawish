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
Route::get('/mail', function () {

    $mail_data=array(
        'name' => 'Abraham Maleko',
        'reference_code' => 929541
    );
    return new App\Mail\WishGrantedMail($mail_data);
});


Route::redirect('/', '/home');
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/requests', [App\Http\Controllers\HomeController::class, 'request'])->name('requests');

Route::post('/request/upload', [App\Http\Controllers\HomeController::class, 'Uploadrequest'])->name('upload-request');

Route::get('/request/grant',[App\Http\Controllers\HomeController::class, 'requestGrant'])->name('request-grant');

Route::get('/request/{id}', [App\Http\Controllers\HomeController::class, 'getWish'])->name('request');

Route::post('/request/update', [App\Http\Controllers\HomeController::class, 'updateRequest'])->name('update-request');

Route::get('/request/delete/{id}', [App\Http\Controllers\HomeController::class, 'deleteRequest'])->name('delete-request');

