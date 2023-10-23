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
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/rota1', function () {
    return 'rota1';
});
Route::get('/rota2', function () {
    return 'rota2';
});
Route::get('/rota3', function () {
    return 'rota3';
});

Route::get('/{any}', function ($any) {
    return $any;
});
