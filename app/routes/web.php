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
    // TODO auth()->user()
    if (true) {
        return view('pages.home');
    }

    return view('pages.login');
})->name('home');

Route::get('/hours', function () {
    return view('pages.hours');
})->name('hours');

Route::get('/providers', function () {
    return view('pages.providers');
})->name('providers');

