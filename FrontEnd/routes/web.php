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
    return view('layout.home');
});

Route::get('/facility', function () {
    return view('layout.facility');
});

Route::get('/gallery', function () {
    return view('layout.gallery');
});

Route::get('/event', function () {
    return view('layout.event');
});

Route::get('/room', function () {
    return view('layout.room');
});

Route::get('/contact', function () {
    return view('layout.contact');
});

Route::get('/book', function () {
    return view('layout.login');
});

Route::get('/register', function () {
    return view('layout.register');
});
