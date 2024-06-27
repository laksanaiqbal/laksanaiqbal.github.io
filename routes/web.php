<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AboutController;

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

Route::get('/', function () {
    return view('landingpage');
});
Route::get('/message', function () {
    return view('admin.messages.index');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

//message
Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages.index');
Route::get('/messages/ajax_list', [MessageController::class, 'ajaxList'])->name('messages.ajaxList');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
Route::get('/messages/{id}/edit', [MessageController::class, 'edit'])->name('messages.edit');
Route::put('/messages/{id}', [MessageController::class, 'update'])->name('messages.update');
Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');

//about
Route::get('/about', [AboutController::class, 'index'])->name('admin.abouts.index');
Route::get('/about/ajax_list', [AboutController::class, 'ajaxList'])->name('abouts.ajaxList');
Route::get('/about/{id}/edit', [AboutController::class, 'edit'])->name('messages.edit');
Route::put('/about/{id}', [AboutController::class, 'update'])->name('abouts.update');

// Route::get('/about', [AboutController::class, 'edit'])->name('admin.about.edit');
//Route::put('/about', [AboutController::class, 'update'])->name('admin.about.update');
