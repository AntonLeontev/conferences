<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');
Route::view('/archive', 'archive')->name('archive');
Route::view('/search', 'search')->name('search');
Route::view('/announcement', 'announcement')->name('announcement');
Route::view('/subject/{subject}', 'subject')->name('subject');
Route::view('/subject/{subject}/{single}', 'single')->name('single');
Route::view('/subject/{subject}/{single}/{country}', 'country')->name('country');
