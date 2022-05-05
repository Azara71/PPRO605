<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GlobalController;

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

Route::get('/', [GlobalController::class,'accueil']);

Route::get('/accueil', [GlobalController::class,'accueil']);

Route::get('/register', [GlobalController::class,'register']);
Route::get('get-facs', [GlobalController::class, 'getFacs'])->name('getFacs');



Route::get('/connexion', [GlobalController::class,'connexion']);

Route::get('/main', [GlobalController::class,'main']);

Route::get('/contact', [GlobalController::class,'contact']);

Route::get('/info_perso', [GlobalController::class,'info_perso']);

Route::get('/mes_conventions', [GlobalController::class,'mes_conventions']);

Route::get('/mes_conventions/create', [GlobalController::class,'mes_conventions_create']);


