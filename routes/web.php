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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Stok Barang
Route::get('/stok/stok_barang', 'StokController@index');
Route::get('/stok/tambah', 'StokController@tambah');
Route::get('/stok/barang_keluar','StokController@keluar');
Route::get('/simpan-barang', 'StokController@simpan');
Route::get('/stok/stok_barang/cari','StokController@cari');
Route::get('/stok/{stok}/delete', 'StokController@hapus_stok');
Route::get('stok/{stok}/show','StokController@show');
Route::get('/stok/{stok}/ubah', 'StokController@ubah_barang');
Route::get('/stok/{stok}/update_barang', 'StokController@update_barang');
//Route::get('/stok/{stok_barang}/detail','StokController@detail');

//Keuangan
Route::get('/keuangan/data_pembeli', 'KeuanganController@index');
Route::get('/keuangan/{pembeli}/riwayat','KeuanganController@riwayat');
Route::get('/keuangan/tambahpembeli','KeuanganController@tambah');
Route::get('/simpan-pembeli','KeuanganController@simpan_pembeli');
Route::get('/keuangan/{pembeli}/delete', 'KeuanganController@hapus');
Route::get('keuangan/{pembeli}/show','KeuanganController@show_pembeli');
Route::get('/keuangan/{pembeli}/ubah', 'KeuanganController@ubah_pembeli');
Route::get('/keuangan/{pembeli}/update_pembeli', 'KeuanganController@update_pembeli');

//Grafik
Route::get('/keuangan/grafik', 'ModalController@grafik');
Route::get('/modal/tambah', 'ModalController@tambah');
Route::get('/modal/hapus', 'ModalController@hapus');

//Kasir
Route::get('/kasir/kasir','KasirController@index');
Route::get('/kasir/tambah_barang','KasirController@tambah');