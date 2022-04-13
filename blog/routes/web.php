<?php

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

Route::get('/gudang/pdf', 'GudangController@pdf')->middleware('auth');
Route::resource('gudang', 'GudangController')->middleware('auth');

Route::get('/barang/pdf', 'BarangController@pdf')->middleware('auth');
Route::resource('barang', 'BarangController')->middleware('auth');

Route::resource('satuan', 'SatuanController')->middleware('auth');

Route::get('/supplier/pdf', 'SupplierController@pdf')->middleware('auth');
Route::resource('supplier', 'SupplierController')->middleware('auth');

Route::get('/customer/pdf', 'CustomerController@pdf')->middleware('auth');
Route::resource('customer', 'CustomerController')->middleware('auth');

Route::get('/pembelian/pdf', 'PembelianController@pdf');
Route::get('/pembelian/filter-form', 'PembelianController@filterForm');
Route::get('/pembelian/filter-pdf', 'PembelianController@filterPdf');
Route::resource('pembelian', 'PembelianController');

Route::get('/mutasi/pdf', 'MutasiController@pdf')->middleware('auth');
Route::resource('mutasi', 'MutasiController')->middleware('auth');

Route::get('/penjualan/pdf', 'PenjualanController@pdf');
Route::get('/penjualan/filter-form', 'PenjualanController@filterForm');
Route::get('/penjualan/filter-pdf', 'PenjualanController@filterPdf');
Route::resource('penjualan', 'PenjualanController');

Route::resource('agenda', 'AgendaController');

Route::resource('user', 'UserController');



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
