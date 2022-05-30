<?php 

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Etape;
use App\Models\Avenant;
use App\Models\Faculte;
use App\Models\Etudiant;
use App\Models\Procedure;
use App\Models\Convention;
use App\Models\Entreprise;
use App\Models\Université;
use App\Models\Travailleur;
use Illuminate\Support\Arr;
use App\Models\Etape_modele;
use Illuminate\Http\Request;
use Illuminate\Support\File;
use App\Models\Procedure_modele;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $conventions_from_user=Auth::user()->conventions;
        $file_to_dl=Convention::find($id);
        if($file_to_dl==NULL ||$conventions_from_user->contains($file_to_dl)==false ){
            abort(404);
        }
       
        else{
        if(Storage::exists($file_to_dl->chemin_convention)){
            return Storage::download($file_to_dl->chemin_convention,'convention.pdf');
            $conventions=Auth::user()->conventions->sortBy('id');
            return redirect()->route('mes_conventions');
        }
        else{
            return back();
        }
        }
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
        $travailleurs_gerant=DB::table('travailleurs')
        ->join('pivot_table_ent_trav_fac','pivot_table_ent_trav_fac.travailleur_id','=','travailleurs.id')
        ->where('faculte_id','=',$faculte[0]->id)
        ->where('job_id','=','7')
        ->get();
         $array=array();
         foreach ($travailleurs_gerant as $gerant){
            $dir=User::where('travailleur_id','=',$gerant->travailleur_id)->get();
            $array[]=$dir;
            $convention->users()->attach($dir);
        }
        return redirect()->route('mes_conventions');

      
     
    }
    public function test(){
        return view('test');
    }

    
    public function maj_convention(Request $request,$id){
         $request->validate([
          'convention'=>['required|mimes:pdf'],
         ]);
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

public function liste_etudiant(){
    if(Auth::user()->travailleur == NULL ){
        abort(404);
    }
    elseif(count(Auth::user()->travailleur->facultes) == 0){
        abort(404);
    }
    else{
    $fac_secretaire=Auth::user()->travailleur->facultes[0];
    $etudiants = DB::table('users')
    ->join('pivot_table_etudiant_faculte','pivot_table_etudiant_faculte.etudiant_id','=','users.etudiant_id')
    ->where('pivot_table_etudiant_faculte.faculte_id','=',$fac_secretaire->id)
    ->join('etudiants','pivot_table_etudiant_faculte.etudiant_id','=','etudiants.id')
    ->get();
    $info_etudiants=array();
    foreach ($etudiants as $etudiant){
        $info=Etudiant::find($etudiant->etudiant_id);
        array_push($info_etudiants,$info);
    }
    

    return view('liste_etudiant',compact('etudiants','fac_secretaire','info_etudiants'));
    }
}


public function csv_to_array($path='',$delimiter=',')
{
     if(!file_exists($path) || !is_readable($path))
        return $path;

     $header = NULL;
     $data = array();
     if (($handle = fopen($path, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;

}
public function ajout_etudiants_csv(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,txt',   
        ]);
        $file = $request->file('file'); // On récupère le champs convention
        $filename= $file->getClientOriginalName(); //On récupère le nom original du fichier 
        $filename=time().'.'.$filename; // On concatène son nom avec le time qui sera donc unique.
        $path = $file->storeAs('csv',$filename); // On l'enregistre dans le fichier conventions avec son nom, il renvoi alros le chemin.
        $complete_path=Storage::path($path);
        $custom_array=GlobalController::csv_to_array($complete_path);
        $data=[];
         for ($i = 0; $i < count($custom_array); $i ++)
         {
           $etudiant=Etudiant::create([
            'num_etudiant' => $custom_array[$i]["num_etudiant"],
            'annee' => $custom_array[$i]["annee"],
           ]);
            $user=User::create([
                'prenom' =>$custom_array[$i]["prenom"],
                'nom' =>$custom_array[$i]["nom"],
                'statut' => 'Etudiant',
                'password'=>Hash::make($custom_array[$i]["password"]),
                'email' => $custom_array[$i]["email"],
                'etudiant_id'=>$etudiant->id,
                'created_at'=>now(),
                'acces_id'=>'1',
            ]);
            $auth_facultes=Auth::user()->travailleur->facultes[0];
            $user->etudiant->facultes()->attach($auth_facultes);
        
         }



        return back();
}


public function voir_avenants(Request $request,$id){
    $conventions_from_user=Auth::user()->conventions;
    $convention=Convention::find($id);

    if($conventions_from_user->contains($convention) == false || $convention==NULL){
        abort(404);
    }
    else{
        // CHARGER LES AVENANTS DE LA CONVENTION
        $avenants=$convention->avenants;
        return view('avenants',compact(['convention','avenants']));
    }
}

public function avenant(Request $request,$id){
    $conventions_from_user=Auth::user()->conventions;
    $avenant=Avenant::find($id);
    $trouve=0;
    $array=[];
    foreach($conventions_from_user as $convention){
    array_push($array,$convention->avenants);
  }
  foreach($array as $arr){
     if($arr->contains($avenant)){
        $trouve=1;
     }

  }
  if($trouve==1){
     if($avenant->procedure->num_etape<=$avenant->procedure->nombre_etapes_max){
        return view('avenant',compact(['avenant']));
    }
    else{
        abort(404);
    }
  }
  else{
      abort(404);
  }
 

}

public function avenant_create(Request $request,$id){
    $convention=Convention::find($id);
    $proc=Procedure_modele::all();
    return view('create_avenant',compact(['convention','proc']));
}
public function upload_avenant(Request $request,$id){
   $request->validate([
            'avenant' => 'required|mimes:pdf',   
            'procedure'=>'required',
            'date_debut'=>'required',
            'date_fin'=>'required',
        ]);
    $convention=Convention::find($id);
    $conventions_from_user=Auth::user()->conventions;

    if($conventions_from_user->contains($convention)==false){
        abort(404);
    }
    else{
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
        $file = $request->file('avenant'); // On récupère le champs convention
        $filename= $file->getClientOriginalName(); //On récupère le nom original du fichier 
        $filename=time().'.'.$filename; // On concatène son nom avec le time qui sera donc unique.
        $path = $file->storeAs('avenants',$filename); // On l'enregistre dans le fichier conventions avec son nom, il renvoi alros le chemin.

        $avenant=Avenant::create([
            'chemin_avenant' => $path,
            'etat_avenant' => '0',
            'date_debut' => $request->date_debut,
            'date_fin' =>$request->date_fin,
            'created_at' => now(),
            'updated_at' => now(),
            'procedure_id'=>$procedure->id,
            'convention_id'=>$convention->id,
        ]);
        




        return redirect()->route('mes_conventions');


    }
}

public function dl_avenant($id){
    
  $avenant=Avenant::find($id);
  $conventions_from_user=Auth::user()->conventions;
  $array=[];
  $trouve=0;
  foreach($conventions_from_user as $convention){
    array_push($array,$convention->avenants);
  }
  foreach($array as $arr){
     if($arr->contains($avenant)){
        $trouve=1;
     }

  }
  if($trouve==1){
        if(Storage::exists($avenant->chemin_avenant)){
             return Storage::download($avenant->chemin_avenant,'avenant.pdf');
        }
        else{
            return back();
        }
  }
  else{
      abort(404);
  }
}
public function maj_avenant(Request $request,$id){
    $request->validate([
        'avenant' => 'required|mimes:pdf',   
    ]);
  $avenant=Avenant::find($id);
  $conventions_from_user=Auth::user()->conventions;
  $array=[];
  $trouve=0;
  foreach($conventions_from_user as $convention){
    array_push($array,$convention->avenants);
  }
  foreach($array as $arr){
     if($arr->contains($avenant)){
        $trouve=1;
     }

  }
  if($trouve==1){
               
        $file = $request->file('avenant'); // On récupère le champs convention
        $filename= $file->getClientOriginalName(); //On récupère le nom original du fichier 
        $filename=time().'.'.$filename; // On concatène son nom avec le time qui sera donc unique.
        $path = $file->storeAs('avenants',$filename); // On l'enregistre dans le fichier conventions avec son nom, il renvoi alros le chemin.
        Storage::delete($convention->chemin_convention);
        $avenant->update(['chemin_avenant'=>$path]);
        $avenant->update(['updated_at'=>now()]);
        if($avenant->procedure->num_etape<=$avenant->procedure->nombre_etapes_max){
            $avenant->procedure->num_etape=$avenant->procedure->num_etape+1;
        }
      
        
        $avenant->save();
        $avenant->procedure->save();

                    

  }
  else{
      abort(404);
  }


}

public function procedures(Request $request){
    $procedures=Procedure_modele::all();
    return view('procedures',compact('procedures'));
}

public function creer_procedure(Request $request){
    $etape_modeles=Etape_modele::all();
    return view('creer_procedure',compact('etape_modeles'));
}

public function ajout_procedure(Request $request){
    $array=[];
    $array_of_select=[];
    $array_of_collection=[]; // Collection Eloquant de modèle d'étapes
    array_push($array_of_select,$request->select1);
    array_push($array_of_select,$request->select2);
    array_push($array_of_select,$request->select3);
    array_push($array_of_select,$request->select4);
    array_push($array_of_select,$request->select5);
    array_push($array_of_select,$request->select6);
    array_push($array_of_select,$request->select7);
    array_push($array_of_select,$request->select8);
    array_push($array_of_select,$request->select9);
    array_push($array_of_select,$request->select10);
    array_push($array_of_select,$request->select11);
    array_push($array_of_select,$request->select12);
    array_push($array_of_select,$request->select13);
    array_push($array_of_select,$request->select14);
    array_push($array_of_select,$request->select15);
    // On insère chaque modèle d'étape choisit envoyé dans la requête HTTP.
     $nb_etapes=0;
    foreach($array_of_select as $select){
        if($select!=NULL){
         $nb_etapes++;
         array_push($array_of_collection,Etape_modele::find($select));   
        }
    }
    // On se créer un modèle de procédure.
    $procedure=Procedure_modele::create([
        'nom_procedure'=>$request->name,
        'nombre_etapes_max'=>$nb_etapes,
    ]);

    foreach($array_of_collection as $etape_modele){
        $etape_modele->procedures()->attach($procedure->id);
    }

  
    return redirect()->route('procedures');

}



}

?>