<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller;

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



// Route::get('hoadon', ['as'=>'hoadon', 'uses' => 'HoaDonController@index']);
// Route::resource('index', 'HoaDonController');
// Route::get('hoadon', ['as' => 'hoaDon', 'uses' => "HoaDonController@Index"]);
// Route::get('/hoadon', [HoaDonController::class, 'Index']);
Route::get('/hoadon', 'App\Http\Controllers\HoaDonController@index');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::any('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Auth::routes();

Route::post('/home/add', [App\Http\Controllers\HomeController::class, 'add']);

Auth::routes();

Route::post('/home/update', [App\Http\Controllers\HomeController::class, 'update']);

Auth::routes();

Route::post('/home/delete', [App\Http\Controllers\HomeController::class, 'delete']);

// Auth::routes();

// Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
