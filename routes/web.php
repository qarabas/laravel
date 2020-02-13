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


Route::resource('/', 'ArchController');
Route::resource('arch', 'ArchController');
Route::get('/create-cell','ArchController@createCell');
Route::resource('cell', 'CellController');
Route::resource('dir', 'DirController');
Route::resource('file', 'FileController');
Route::get('search', 'SearchController@index')->name('search');
