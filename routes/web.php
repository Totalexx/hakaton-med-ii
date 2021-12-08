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
    return view('planets');
});

Route::get('/game1', function () {
    return view('game1');
});

Route::get('/results', function () {
    return view('results');
});

Route::get('/progress', function () {
    return view('progress');
});

Route::get('/redirect1', function () {
    return redirect('/game1');
});
