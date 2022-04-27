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
Route::get('/accueil', function () {
    return view('accueil');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/connexion', function () {
    return view('connexion');
});
Route::get('/main', function () {
    return view('main');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/info_perso', function () {
    return view('info_perso');
});
Route::get('/mes_conventions', function () {
    return view('mes_conventions');
});


