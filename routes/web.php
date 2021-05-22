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

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/wishes', [App\Http\Controllers\HomeController::class, 'wishes'])->name('wishes');

Route::get('/requests', [App\Http\Controllers\HomeController::class, 'request'])->name('requests');

Route::get('/statistics', [App\Http\Controllers\HomeController::class, 'stats'])->name('stats');

Route::get('/all/statistics', [App\Http\Controllers\HomeController::class, 'allStats'])->name('all-stats');

Route::post('/request/upload', [App\Http\Controllers\HomeController::class, 'Uploadrequest'])->name('upload-request');

Route::get('/request/grant',[App\Http\Controllers\HomeController::class, 'requestGrant'])->name('request-grant');

Route::get('/request/{id}', [App\Http\Controllers\HomeController::class, 'getWish'])->name('request');

Route::post('/request/update', [App\Http\Controllers\HomeController::class, 'updateRequest'])->name('update-request');

Route::get('/request/delete/{id}', [App\Http\Controllers\HomeController::class, 'deleteRequest'])->name('delete-request');

Route::get('/request/approve/{id}', [App\Http\Controllers\HomeController::class, 'approveRequest'])->name('approve-request');

Route::post('/request/decline', [App\Http\Controllers\HomeController::class, 'declineRequest'])->name('decline-request');

Route::post('/request_names', [App\Http\Controllers\HomeController::class, 'requestee_names'])->name('requestee-names');

Route::post('/request_info', [App\Http\Controllers\HomeController::class, 'requestInfo'])->name('request-info');

Route::get('/pdf/wishes', [App\Http\Controllers\HomeController::class, 'requestPdf'])->name('request-pdf');

Route::GET('/excel/request', [App\Http\Controllers\HomeController::class, 'requestExcel'])->name('request-excel');

Route::get('/filter/wishes', [App\Http\Controllers\HomeController::class, 'filterWishes'])->name('filter-wishes');

Route::resource('/experience',App\Http\Controllers\ExperienceController::class);

