<?php

use Illuminate\Support\Facades\Auth;
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
//auth routes
Auth::routes(['register' => false]);

//locale route
Route::get('locale/{lang}',[App\Http\Controllers\LanguageController::class, 'setLanguage'])->name('locale');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/wishes', [App\Http\Controllers\HomeController::class, 'wishes'])->name('wishes');

Route::get('/status', [App\Http\Controllers\HomeController::class, 'status'])->name('status');

Route::get('/admin/status', [App\Http\Controllers\AdminController::class, 'adminStatus'])->name('admin-status');

Route::get('/admin/all_wishes', [App\Http\Controllers\AdminController::class, 'wishData'])->name('admin-wishData');

Route::post('/request/upload', [App\Http\Controllers\HomeController::class, 'Uploadrequest'])->name('upload-request');

Route::get('/request/grant',[App\Http\Controllers\HomeController::class, 'requestGrant'])->name('request-grant');

Route::get('/request/{id}', [App\Http\Controllers\HomeController::class, 'getWish'])->name('request');

Route::post('/request/update', [App\Http\Controllers\HomeController::class, 'updateRequest'])->name('update-request');

Route::get('/request/delete/{id}', [App\Http\Controllers\HomeController::class, 'deleteRequest'])->name('delete-request');

Route::get('/request/approve/{id}', [App\Http\Controllers\AdminController::class, 'approveRequest'])->name('approve-request');

Route::post('/request/decline', [App\Http\Controllers\AdminController::class, 'declineRequest'])->name('decline-request');

Route::post('/request_names', [App\Http\Controllers\HomeController::class, 'requestee_names'])->name('requestee-names');

Route::post('/request_info', [App\Http\Controllers\HomeController::class, 'requestInfo'])->name('request-info');

Route::get('/pdf/wishes/{filter?}', [App\Http\Controllers\HomeController::class, 'requestPdf'])->name('request-pdf');

Route::GET('/excel/request', [App\Http\Controllers\HomeController::class, 'requestExcel'])->name('request-excel');

Route::get('/filter/wishes', [App\Http\Controllers\HomeController::class, 'filterWishes'])->name('filter-wishes');

Route::resource('/experience',App\Http\Controllers\ExperienceController::class);

Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contactUs'])->name('contact');

Route::get('/newwish', [App\Http\Controllers\HomeController::class, 'showNewWish'])->name('new-wish');
