<?php 

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Etape;
use App\Models\Faculte;
use App\Models\Etudiant;
use App\Models\Procedure;
use App\Models\Convention;
use App\Models\Entreprise;
use App\Models\Université;
use App\Models\Travailleur;
use App\Models\Etape_modele;
use Illuminate\Http\Request;
use Illuminate\Support\File;
use App\Models\Procedure_modele;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class GlobalController extends Controller{
    /*
    * __construct retournant le middleware Auth, permettant de faire un redirect sur la page login
    */
    public function __construct(){
        $this->middleware('auth')->except(['accueil','getFacs','getJobs','getEtapes','getTuteurs']);
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
        $jobs=Job::all();
        return view('register',compact('univs','entreprise','jobs'));
    } 
    public function getFacs(Request $request)
    {
        $facs=Faculte::where('université_id',$request->univ_id)->get(); // Recupération de toutes les facultés dont la clef étrangère est égale à univ_id, la clef donné par la requête Ajax.
        
        if (count($facs) > 0) {
            return response()->json($facs); // EVITE ERROR 500
        }
    }
    // Renvoi les jobs disponible dans l'entreprise/fac sous format Json en fonction de l'ID de l'entreprise/fac sélectionné
    public function getJobs(Request $request)
    {  if($request->ent_id>0){
        $jobs=DB::table('jobs')
        ->join('pivot_table_ent_fac_job','jobs.id','=','pivot_table_ent_fac_job.job_id')
        ->join('entreprises','pivot_table_ent_fac_job.entreprise_id','=','entreprises.id')
        ->where('entreprises.id','=',$request->ent_id)
        ->get();
        if(count($jobs)>0)
        {        
            return response()->json($jobs);
        }
    }
    elseif($request->fac_id>0){
        $jobs=DB::table('jobs')
        ->join('pivot_table_ent_fac_job','jobs.id','=','pivot_table_ent_fac_job.job_id')
        ->join('facultes','pivot_table_ent_fac_job.faculte_id','=','facultes.id')
        ->where('facultes.id','=',$request->fac_id)
        ->get();
        if(count($jobs)>0)
        {        
            return response()->json($jobs);
        }
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
        $user->travailleur->update(['job_id'=>$request->job]); 
        $job_to_attach=Job::find($request->job);
        $user->travailleur->job=$job_to_attach;
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
     /* $conventions=DB::table('conventions')
        ->join('pivot_table_convention_user','conventions.id','=','pivot_table_convention_user.convention_id')
        ->join('users','users.id','=','pivot_table_convention_user.user_id')
        ->where('users.id','=',Auth::user()->id)
        ->paginate(3);
        */
    $conventions=Auth::user()->conventions->sortBy('id');
    
        return view('mes_conventions',compact('conventions'));
}
public function dl($id)
{   
        $file_to_dl=Convention::find($id);
        return Storage::download($file_to_dl->chemin_convention,'convention.pdf');
        $conventions=Auth::user()->conventions->sortBy('id');
        return redirect()->route('mes_conventions');
}
public function edit($id)
{
    
    $convention=DB::table('conventions')  
     ->where('conventions.id','=',$id)
     ->join('pivot_table_convention_user','conventions.id','=','pivot_table_convention_user.convention_id')
     ->where('pivot_table_convention_user.user_id','=',Auth::user()->id)
     ->get();
     if(count($convention)>0){
      
        $procedure=Procedure::find($convention[0]->procedure_id);
        if($procedure != NULL){
            $etapes=DB::table('etapes')
            ->join('pivot_table_etape_procedure','pivot_table_etape_procedure.etape_id','=','etapes.id')
            ->join('procedures','pivot_table_etape_procedure.procedure_id','=','procedures.id')
            ->where('procedures.id','=',$convention[0]->procedure_id)
            ->orderBy('etapes.id')
            ->get();
        }

        if($procedure->num_etape<=$procedure->nombre_etapes_max){
            $etape_en_cours=$etapes[$procedure->num_etape-1];
            $etape_en_cours_modele=Etape_modele::find($etape_en_cours->etape_modele_id);
            $etape_acces=$etape_en_cours_modele->acces;
        }
        else {
            abort(404);
        }
     }
     
 
    if(count($convention)>0 && $procedure != NULL && count($etapes)>0){
     return view('edit_convention',compact('convention','procedure','etapes','etape_en_cours','etape_en_cours_modele','etape_acces'));
    }
    else{
        abort(404);
    }
}
// Controle de la page principal
public function main()
{
    return view('main');
}

public function mes_conventions_create(){
    if(Auth::user()->statut=='Etudiant'){
        $proc=Procedure_modele::all();
        $entreprise=Entreprise::all();
        return view('create_convention',compact(['proc','entreprise']));
    }
    else{
        abort(404); // Protection de création d'une convention .
    }
}

    public function getEtapes(Request $request)
    {
      
        $etapes=DB::table('etape_modeles')
        ->join('pivot_table_modeleprocedure_etape','etape_modeles.id','=','pivot_table_modeleprocedure_etape.etape_modele_id')
        ->join('procedure_modeles','pivot_table_modeleprocedure_etape.procedure_modeles_id','=','procedure_modeles.id')
        ->where('procedure_modeles.id','=',$request->procedure_id)
        ->get();
        if (count($etapes) > 0) {
            return response()->json($etapes); // EVITE ERROR 500
        }
    }
  public function getTuteurs(Request $request)
    {
        $tuteurs=DB::table('users')
        ->join('travailleurs','travailleurs.id','=','users.travailleur_id')
        ->join('pivot_table_ent_trav_fac','travailleurs.id','=','pivot_table_ent_trav_fac.travailleur_id')
        ->join('entreprises','entreprises.id','=','pivot_table_ent_trav_fac.entreprise_id')
        ->where('entreprises.id','=',$request->ent_id)
        ->get();
   
        
        if (count($tuteurs) > 0) {
            return response()->json($tuteurs); // EVITE ERROR 500
        }
    }

    public function upload_convention(Request $request)
    {
        $request->validate([
            'convention' => 'required|mimes:pdf',
            'tuteur_selection' => 'required',
            'entreprise_selection' =>'required',
        ]);
        $procedure_modeles=DB::table('procedure_modeles')
        ->where('procedure_modeles.id','=',$request->procedure)
        ->get();

       foreach($procedure_modeles as $procedure_modele){
           // Création d'une nouvelle procédure pour chaque modèle associé (Inutile car un seul associé)
            $procedure=Procedure::create([
                'num_etape'=>'1',
                'procedure_modeles_id'=>$procedure_modele->id,
                'nombre_etapes_max'=>$procedure_modele->nombre_etapes_max,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
         
            // Récupération des étapes modèles lié à la procédure modèles afin de les copier à la nouvelle procédure.
            $etape_modeles=DB::table('etape_modeles')
            ->join('pivot_table_modeleprocedure_etape','pivot_table_modeleprocedure_etape.etape_modele_id','=','etape_modeles.id')
            ->join('procedure_modeles','pivot_table_modeleprocedure_etape.procedure_modeles_id','=','procedure_modeles.id')
            ->where('procedure_modeles.id','=',$procedure_modele->id)
            ->get(); 
            // Création des étapes héritant des étapes modèles
            foreach($etape_modeles as $etape_modele){
                $etape=Etape::create([
                    'description'=>$etape_modele->description,
                    'etat'=>'0',
                    'created_at'=>now(),
                    'updated_at'=>now(),
                    'etape_modele_id'=>$etape_modele->etape_modele_id, // BUG DE LARAVEL SUR LE LINKAGE DE L'ID ??
                ]);
                $procedure->etapes()->attach($etape);
            }
       }
       
        
           
        $file = $request->file('convention'); // On récupère le champs convention
        $filename= $file->getClientOriginalName(); //On récupère le nom original du fichier 
        $filename=time().'.'.$filename; // On concatène son nom avec le time qui sera donc unique.
        $path = $file->storeAs('conventions',$filename); // On l'enregistre dans le fichier conventions avec son nom, il renvoi alros le chemin.
        $travailleur_tuteur=Travailleur::find($request->tuteur_selection); // On trouve le travailleur grâce à l'id passé par le formulaire html
        $convention=Convention::create([
                'description'=>$request->description,
                'chemin_convention'=>$path,
                'date_creation'=>now(),
                'date_derniere_modification'=>now(),
                'procedure_id'=>$procedure->id,
                'date_debut'=>$request->date_debut,
                'date_fin'=>$request->date_fin,
                'tuteur_id'=>$travailleur_tuteur->user->id,
        ]);
        $travailleur_tuteur=Travailleur::find($request->tuteur_selection); 
        
        $convention->users()->attach($travailleur_tuteur->user);
        $convention->users()->attach(Auth::user());
        
      
       $directeurs=DB::table('travailleurs')
        ->join('pivot_table_ent_trav_fac','pivot_table_ent_trav_fac.travailleur_id','=','travailleurs.id')
        ->where('entreprise_id','=',$request->entreprise_selection)
        ->where('job_id','=','2')
        ->get();
        
           foreach ($directeurs as $directeur){
            $sec=User::where('travailleur_id','=',$directeur->travailleur_id)->get();
            $array[]=$sec;
            $convention->users()->attach($sec);
        }


        $faculte=Auth::user()->etudiant->facultes;
        $travailleurs_secretaires=DB::table('travailleurs')
        ->join('pivot_table_ent_trav_fac','pivot_table_ent_trav_fac.travailleur_id','=','travailleurs.id')
        ->where('faculte_id','=',$faculte[0]->id)
        ->where('job_id','=','8')
        ->get();
       
        foreach ($travailleurs_secretaires as $secretaire){
            $sec=User::where('travailleur_id','=',$secretaire->travailleur_id)->get();
            $array[]=$sec;
            $convention->users()->attach($sec);
        }

         $travailleurs_directeur=DB::table('travailleurs')
        ->join('pivot_table_ent_trav_fac','pivot_table_ent_trav_fac.travailleur_id','=','travailleurs.id')
        ->where('faculte_id','=',$faculte[0]->id)
        ->where('job_id','=','1')
        ->get();
         $array=array();
         foreach ($travailleurs_directeur as $directeur){
            $dir=User::where('travailleur_id','=',$directeur->travailleur_id)->get();
            $array[]=$dir;
            $convention->users()->attach($dir);
        }
                  return redirect()->route('test')->with('procedure_modeles',$travailleur_tuteur);

      
     
    }
    public function test(){
        return view('test');
    }

    
    public function maj_convention(Request $request,$id){
        $convention=Convention::find($id);
      
        if (Auth::user()->conventions->contains($convention) ){
      
        $etape=$convention->procedure->etapes[$convention->procedure->num_etape-1];
                
        if($etape->etape_modele->acces->Description==Auth::user()->acces->Description){        
                    $etape->update(['etat'=>1]);
                    $etape->save();
                    if($convention->procedure->num_etape<=$convention->procedure->nombre_etapes_max){
                        $convention->procedure->num_etape=$convention->procedure->num_etape+1;
                      
                    }
                    
        $file = $request->file('convention'); // On récupère le champs convention
        $filename= $file->getClientOriginalName(); //On récupère le nom original du fichier 
        $filename=time().'.'.$filename; // On concatène son nom avec le time qui sera donc unique.
        $path = $file->storeAs('conventions',$filename); // On l'enregistre dans le fichier conventions avec son nom, il renvoi alros le chemin.

        Storage::delete($convention->chemin_convention);



        $convention->update(['chemin_convention'=>$path]);
        $convention->update(['date_derniere_modification'=>now()]);
        $convention->procedure->save();


            if($convention->procedure->num_etape<$convention->procedure->nombre_etapes_max){
                return redirect()->route('test')->with('procedure_modeles',$etape->etape_modele->acces);
            }
            else{
                return redirect()->route('mes_conventions');
            }

        }
        }

        else{
            abort(404);
        }
    }




}

?>