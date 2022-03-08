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
Route::get('/', 'App\Http\Controllers\HitungController@landing')->middleware('guest');

Route::get('/regis','App\Http\Controllers\AuthController@getRegis')->middleware('guest');
Route::get('/login','App\Http\Controllers\AuthController@getLogin')->name('login')->middleware('guest');
Route::post('/login','App\Http\Controllers\AuthController@postLogin')->name('postlogin');

Route::group(['middleware' =>['auth:masyarakat']], function (){
    Route::get('/estimasi','App\Http\Controllers\HitungController@landing');
    Route::get('/hitung','App\Http\Controllers\HitungController@index')->name('hitung');
    Route::post('/hitung','App\Http\Controllers\HitungController@hitungEstimasi')->name('hitung');
    Route::get('/hasil','App\Http\Controllers\HitungController@hitungEstimasi');
    Route::get('/cetak','App\Http\Controllers\HitungController@cetak');
    Route::get('/riwayat','App\Http\Controllers\HitungController@riwayatEstimasi');
    Route::get('/akun','App\Http\Controllers\MasyarakatController@index');
    Route::patch('/akun','App\Http\Controllers\MasyarakatController@edit')->name('edit_user');
    Route::post('/akun','App\Http\Controllers\MasyarakatController@editpass')->name('edit_pass_akun');
   
});

Route::group(['middleware' =>['auth:admin']], function (){
    Route::get('/dashboard','App\Http\Controllers\AdminController@index');
    //indeks
    Route::get('/dashboard/indeks','App\Http\Controllers\IndekController@index');
    Route::post('/dashboard/indeks','App\Http\Controllers\IndekController@store')->name('input_indeks');
    Route::patch('/dashboard/indeks','App\Http\Controllers\IndekController@update')->name('edit_indeks');
    Route::put('dashboard/indeks/{indeks}','App\Http\Controllers\IndekController@updateStatus')->name('edit_keaktifan');
    //sarana
    Route::get('/dashboard/sarana','App\Http\Controllers\SaranaController@index');
    Route::post('/dashboard/sarana','App\Http\Controllers\SaranaController@store')->name('input_sarana');
    Route::patch('/dashboard/sarana','App\Http\Controllers\SaranaController@update')->name('edit_sarana');
    Route::put('dashboard/sarana/{sarana}','App\Http\Controllers\SaranaController@updateStatus')->name('edit_statusSarana');
    //gedung
    Route::get('/dashboard/gedung','App\Http\Controllers\GedungController@index');
    Route::post('/dashboard/gedung','App\Http\Controllers\GedungController@store')->name('input_gedung');
    Route::patch('/dashboard/gedung','App\Http\Controllers\GedungController@update')->name('edit_gedung');
    Route::put('dashboard/gedung/{gedung}','App\Http\Controllers\GedungController@updateStatus')->name('edit_statusGedung');
    //kategoriIndeks
    Route::get('/dashboard/kategoriIndeks','App\Http\Controllers\KategoriIndeksController@index');
    Route::post('/dashboard/kategoriIndeks','App\Http\Controllers\KategoriIndeksController@store')->name('input_kategoriIndeks');
    Route::patch('/dashboard/kategoriIndeks','App\Http\Controllers\KategoriIndeksController@update')->name('edit_kategoriIndeks');
    Route::put('dashboard/kategoriIndeks/{kategoriIndeks}','App\Http\Controllers\KategoriIndeksController@updateStatus')->name('edit_statusKategori');
    //masyarakat
    Route::get('/dashboard/masyarakat','App\Http\Controllers\MasyarakatController@tampil');
    Route::put('dashboard/masyarakat/{masyarakat}','App\Http\Controllers\MasyarakatController@updateStatus')->name('edit_statusUser');
    //admin
    Route::get('/profil','App\Http\Controllers\AdminController@profil');
    Route::patch('/profil','App\Http\Controllers\AdminController@edit')->name('edit_admin');
    Route::post('/profil','App\Http\Controllers\AdminController@editpass')->name('edit_pass_admin');
    //estimasi
    Route::get('/dashboard/estimasi','App\Http\Controllers\EstimasiController@index');
});

Route::get('/logout','App\Http\Controllers\AuthController@getLogout');
Route::post('/regis','App\Http\Controllers\AuthController@postRegis')->name('regis');


});