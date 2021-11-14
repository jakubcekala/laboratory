<?php

use App\Http\Controllers\Backend\BoardController;
use App\Http\Controllers\Backend\ChangePasswordController;
use App\Http\Controllers\Backend\ItemController;
use App\Http\Controllers\Backend\UnauthorizedController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\DynamicPDFController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/unauthorized', function () {
    return view('unauthorized.index');
});
Route::get('/unauthorized', [UnauthorizedController::class, 'index'])->name('unauthorized');
Route::resource('unauthorized', UnauthorizedController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class);
Route::resource('items', ItemController::class);
Route::resource('board', BoardController::class);
Route::post('users/{user}/change-password', [ChangePasswordController::class, 'change_password'])->name('users.change.password');
Route::get('items/fetch_image/{id}', [ItemController::class, 'fetch_image']);
Route::get('dynamic_pdf', [DynamicPDFController::class, 'index']);
Route::get('/dynamic_pdf/pdf', [DynamicPDFController::class, 'pdf']);
