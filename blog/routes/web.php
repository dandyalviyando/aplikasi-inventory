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

Route::get('/', function () {
    return view('layouts.master');
});

Route::get('/gudang/pdf', 'GudangController@pdf');
Route::resource('gudang', 'GudangController');

Route::get('/barang/pdf', 'BarangController@pdf');
Route::resource('barang', 'BarangController');

Route::resource('satuan', 'SatuanController');

Route::get('/supplier/pdf', 'SupplierController@pdf');
Route::resource('supplier', 'SupplierController');

Route::get('/customer/pdf', 'CustomerController@pdf');
Route::resource('customer', 'CustomerController');

Route::get('/pembelian/pdf', 'PembelianController@pdf');
Route::resource('pembelian', 'PembelianController');

Route::get('/mutasi/pdf', 'MutasiController@pdf');
Route::resource('mutasi', 'MutasiController');

Route::get('/penjualan/pdf', 'PenjualanController@pdf');
Route::resource('penjualan', 'PenjualanController');


