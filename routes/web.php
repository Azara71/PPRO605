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
Route::get('get-facs', [GlobalController::class, 'getFacs'])->name('getFacs'); //Route permettant d'obtenir le selection dépendant , il prend l'url en get "get-facs" et return un json contenant les facultés liés à l'université choisit
Route::get('get-jobs', [GlobalController::class, 'getJobs'])->name('getJobs'); //Route permettant d'obtenir le selection dépendant , il prend l'url en get "get-facs" et return un json contenant les facultés liés à l'université choisit



Route::get('/connexion', [GlobalController::class,'connexion']);

Route::get('/main', [GlobalController::class,'main']);

Route::get('/contact', [GlobalController::class,'contact']);

Route::get('/info_perso', [GlobalController::class,'info_perso'])->name('info_perso');
Route::post('/modify',[GlobalController::class,'modify'])->name('modify');
Route::get('/add_entreprise',[GlobalController::class,'add_entreprise'])->name('add_entreprise');
Route::post('ajout_entreprise',[GlobalController::class,'ajout_entreprise'])->name('ajout_entreprise');

Route::get('/mes_conventions', [GlobalController::class,'mes_conventions'])->name('mes_conventions');

Route::get('/mes_conventions/create', [GlobalController::class,'mes_conventions_create']);
Route::get('/mes_conventions/dl/{id}', [GlobalController::class,'dl']);
Route::get('/mes_conventions/edit_convention/{id}',[GlobalController::class,'edit'])->name('edit');
Route::get('/mes_conventions/voir_avenants/{id}',[GlobalController::class,'voir_avenants'])->name('voir_avenants');
Route::get('/mes_conventions/avenant/{id}',[GlobalController::class,'avenant'])->name('avenant');
Route::get('/mes_conventions/{id}/avenant/create',[GlobalController::class,'avenant_create'])->name('avenant_create');
Route::post('upload_avenant/{id}',[GlobalController::class,'upload_avenant'])->name('upload_avenant');
Route::get('/mes_conventions/dl_avenant/{id}',[GlobalController::class,'dl_avenant'])->name('dl_avenant');
Route::post('/maj_avenant/{id}',[GlobalController::class,'maj_avenant'])->name('maj_avenant');


Route::get('get-etapes',[GlobalController::class, 'getEtapes'])->name('getEtapes'); 
Route::get('get-tuteurs',[GlobalController::class,'getTuteurs'])->name('getTuteurs');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('liste_etudiant',[GlobalController::class,'liste_etudiant'])->name('liste_etudiant');
Route::post('upload_convention',[GlobalController::class,'upload_convention'])->name('upload_convention');
Route::post('maj_convention/{id}',[GlobalController::class,'maj_convention'])->name('maj_convention');
Route::post('ajout_etudiants_csv',[GlobalController::class,'ajout_etudiants_csv'])->name('ajout_etudiants_csv');
require __DIR__.'/auth.php';
Route::get('test',[GlobalController::class,'test'])->name('test');
?>