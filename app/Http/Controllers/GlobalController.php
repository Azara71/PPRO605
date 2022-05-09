<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Faculte;
use App\Models\Etudiant;
use App\Models\Procedure;
use App\Models\Entreprise;
use App\Models\Université;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class GlobalController extends Controller{
    /*
    * __construct retournant le middleware Auth, permettant de faire un redirect sur la page login
    */
    public function __construct(){
        $this->middleware('auth')->except(['accueil','getFacs']);
    }
    public function accueil()
    {  
        $test=Procedure::find(1);
        return view('accueil',compact('test'));
    }

    // Controle de l'enregistrement
    public function register()
    {
        $univs=Université::all();
        $entreprise=Entreprise::all();
        return view('register',compact('univs','entreprise'));
    } 
    public function getFacs(Request $request)
    {
       $facs=Faculte::where('université_id',$request->univ_id)->get(); // Recupération de toutes les facultés dont la clef étrangère est égale à univ_id, la clef donné par la requête Ajax.
        
        if (count($facs) > 0) {
            return response()->json($facs);
        }
    }
 

    // Controle de la connexion

    public function connexion()
    {
        return view('connexion');
    }
    // Controle de la page de contact
    public function contact()
    {
        return view('contact');
    }    
    // Controle de la page d'info_perso

    public function info_perso()
    {
        return view('info_perso');
    }
    public function modify(Request $request){
        
        $user = Auth::user();
        if($request->prenom!=NULL){
            $user->prenom = $request->prenom;
        }
        if($request->nom!=NULL){
            $user->nom = $request->nom;
        }
      /*  $user->prenom=$request->prenom;
        $user->mail=$request->mail;
        $user->staut=$request->statut;*/
        $user->save();

        return view('info_perso');
    }
    // Controle de la page d'affichage des conventions

    public function mes_conventions()
    {
        return view('mes_conventions');
    }
    
    // Controle de la page principal
    public function main()
    {
        return view('main');
    }

    public function mes_conventions_create(){
        return view('create_convention');
    }
    
}

?>