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
Route::group(['middleware' => 'revalidate'],function(){
Route::get('/', function () {
    return view('login');
});

Route::get('/regis','App\Http\Controllers\AuthController@getRegis')->middleware('guest');
Route::get('/login','App\Http\Controllers\AuthController@getLogin')->name('login')->middleware('guest');
Route::post('/login','App\Http\Controllers\AuthController@postLogin')->name('postlogin');

Route::group(['middleware' =>['auth:masyarakat']], function (){
    Route::get('/estimasi','App\Http\Controllers\MasyarakatController@index');
});

Route::group(['middleware' =>['auth:admin']], function (){
    Route::get('/dashboard','App\Http\Controllers\AdminController@index');
    Route::get('/dashboard/indeks','App\Http\Controllers\IndekController@index');
    Route::post('/dashboard/indeks','App\Http\Controllers\IndekController@store')->name('input_indeks');
});

Route::get('/logout','App\Http\Controllers\AuthController@getLogout');
Route::post('/regis','App\Http\Controllers\AuthController@postRegis')->name('regis');


});