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
        $entreprise=Entreprise::all();
        return view('info_perso',compact('entreprise'));
    }
    public function modify(Request $request){
        
        $user = Auth::user();
        if($request->prenom!=NULL){
            $user->update(['prenom'=>$request->prenom]);
        }
        if($request->nom!=NULL){
            $user->update(['nom'=>$request->nom]);
        }
        if($request->entreprise!=NULL){
        $user->travailleur->entreprises()->detach(); //Detach all avant d'attacher la nouvelle entreprise
        $entreprise_to_attach=Entreprise::find($request->entreprise);
        $user->travailleur->entreprises()->attach($entreprise_to_attach);
        }
        
        if($request->job!=NULL){
            $user->travailleur->update(['job'=>$request->job]); 
        }
        $user->save();
         return redirect()->route('info_perso');
    }

    public function add_entreprise(Request $request){
        return view('add_entreprise');
    }
    public function ajout_entreprise(Request $request){
        $request->validate([
            'num_siret'=>['required'],
            'nom_entreprise'=>['required','string','max:255'],
            'adresse_entreprise'=>['required','string','max:255'],
        ]);
        $entreprise=Entreprise::create([
            'num_siret'=>$request->num_siret,
            'nom_entreprise'=>$request->nom_entreprise,
            'adresse_entreprise'=>$request->adresse_entreprise,
        ]);
        return redirect()->route('info_perso');
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