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

Route::resource('items', '\App\Http\Controllers\ItemController')->middleware('auth');
Route::resource('categories', '\App\Http\Controllers\CategoryController')->middleware('auth');

Route::get('/public/{id}/details', 'App\Http\Controllers\PublicController@details')->name('public.details');

Route::get('/public/{id}/update_cart', 'App\Http\Controllers\PublicController@update_cart')->name('public.update_cart');
Route::put('/public/{id}/update_cart', 'App\Http\Controllers\PublicController@update_cart')->name('public.update_cart');
Route::delete('/public/{id}/update_cart', 'App\Http\Controllers\PublicController@update_cart')->name('public.update_cart');
Route::patch('/public/{id}/update_cart', 'App\Http\Controllers\PublicController@update_cart')->name('public.update_cart');


Route::get('/public/{id}/addToCart', 'App\Http\Controllers\PublicController@addToCart')->name('public.addToCart');
Route::get('/public/{id}/remove_item', 'App\Http\Controllers\PublicController@remove_item')->name('public.remove_item');
Route::delete('/public/{id}/remove_item', 'App\Http\Controllers\PublicController@remove_item')->name('public.remove_item');






Route::resource('public', '\App\Http\Controllers\PublicController');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
