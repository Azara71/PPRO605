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
Route::get('/accueil', [GlobalController::class,'accueil'])->name('accueil');
Route::get('/register', [GlobalController::class,'register']);

Route::get('get-facs', [GlobalController::class, 'getFacs'])->name('getFacs'); //Route permettant d'obtenir le selection dépendant , il prend l'url en get "get-facs" et return un json contenant les facultés liés à l'université choisit
Route::get('get-jobs', [GlobalController::class, 'getJobs'])->name('getJobs'); //Route permettant d'obtenir le selection dépendant , il prend l'url en get "get-facs" et return un json contenant les facultés liés à l'université choisit



Route::get('/connexion', [GlobalController::class,'connexion']); // Route permettant l'accès à l'URL /connexion

Route::get('/main', [GlobalController::class,'main'])->name('main');

Route::get('/contact', [GlobalController::class,'contact'])->name('contact');

Route::get('/info_perso', [GlobalController::class,'info_perso'])->name('info_perso');
Route::post('/modify',[GlobalController::class,'modify'])->name('modify'); // Route en POST, accès par un formulaire dans /info_perso, permet de changer ses informations persos
Route::get('/add_entreprise',[GlobalController::class,'add_entreprise'])->name('add_entreprise'); // Route ramenant à la page d'ajout d'une entreprise
Route::post('ajout_entreprise',[GlobalController::class,'ajout_entreprise'])->name('ajout_entreprise'); // Route en POST, accès par un formulaire dans add_entreprise. 

Route::get('/mes_conventions', [GlobalController::class,'mes_conventions'])->name('mes_conventions');

Route::get('/mes_conventions/create', [GlobalController::class,'mes_conventions_create']);
Route::get('/mes_conventions/dl/{id}', [GlobalController::class,'dl']);
Route::get('/mes_conventions/edit_convention/{id}',[GlobalController::class,'edit'])->name('edit');
Route::get('/mes_conventions/voir_avenants/{id}',[GlobalController::class,'voir_avenants'])->name('voir_avenants');
Route::get('/mes_conventions/avenant/{id}',[GlobalController::class,'avenant'])->name('avenant');
Route::get('/mes_conventions/{id}/avenant/create',[GlobalController::class,'avenant_create'])->name('avenant_create');

Route::post('upload_avenant/{id}',[GlobalController::class,'upload_avenant'])->name('upload_avenant'); // Route permettant d'upload un avenant pour la convention dont l'ID est stipulé dans {id}, permet de rattacher l'avenant
Route::get('/mes_conventions/dl_avenant/{id}',[GlobalController::class,'dl_avenant'])->name('dl_avenant'); // Route permettant de DL l'avenant dont l'ID est passé sur la route
Route::post('/maj_avenant/{id}',[GlobalController::class,'maj_avenant'])->name('maj_avenant'); // Route permettant de mettre à jour l'avenant, on y passe l'ID de l'avenant dans {id} pour le retrouver dans le controller 


Route::get('get-etapes',[GlobalController::class, 'getEtapes'])->name('getEtapes'); // Route permettant la selection dépendant des étapes d'une procédure dans la création d'une convention/avenant
Route::get('get-tuteurs',[GlobalController::class,'getTuteurs'])->name('getTuteurs'); // Route renvoyant les potentiels tuteurs dans une entreprise, accès par du ajax

Route::get('procedures',[GlobalController::class,'procedures'])->name('procedures'); // Permet d'afficher la page de procédures, afin de les lister, et d'en rajouter
Route::get('creer_procedure',[GlobalController::class,'creer_procedure'])->name('creer_procedure'); // Permet d'afficher le formulaire de création d'une procédure
Route::post('ajout_procedure',[GlobalController::class,'ajout_procedure'])->name('ajout_procedure'); // Route en POST permettant de récupérer les infos de ce formulaire,et d'enregistrer la nouvelle procédure

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('liste_etudiant',[GlobalController::class,'liste_etudiant'])->name('liste_etudiant'); // Route permettant d'afficher la liste des étudiants dans la même faculté que l'Auth() 
Route::post('upload_convention',[GlobalController::class,'upload_convention'])->name('upload_convention'); // Route permettant d'upload la convention dans la création d'une convention
Route::post('maj_convention/{id}',[GlobalController::class,'maj_convention'])->name('maj_convention'); // Route permettant de mettre à jour la convention dont l'ID est {id } dans la BDD
Route::post('ajout_etudiants_csv',[GlobalController::class,'ajout_etudiants_csv'])->name('ajout_etudiants_csv'); // Route permettant de passer un .csv dans un formulaire, de le récupérer et de créer les étudiants spécifiés dedans.
require __DIR__.'/auth.php';
Route::get('test',[GlobalController::class,'test'])->name('test'); // Route de test , utile afin d'afficher les différents objets / tableaux / variables qu'on y passe grâce à un redirect dessus (Juste utile pour afficher grâce à un dd($variable)
?>