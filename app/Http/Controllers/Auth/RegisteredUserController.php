<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Faculte;
use App\Models\Etudiant;
use App\Models\Entreprise;
use App\Models\Université;
use App\Models\Travailleur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $univs=Université::all();
        $entreprise=Entreprise::all();
        return view('auth.register',compact('univs','entreprise'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    /*
    Si c'est un étudiant :
1) Tu récupères le numéro d'étudiant, l'année choisit, tu crées l'étudiant et tu récupères son ID
2) Tu récupères la faculté choisit 
3) Tu rentres dans la table pivot étudiant-faculté l'ID de l'étudiant récupéré et la faculté choisit 
*/
    public function store(Request $request)
    {
        // On regarde si les champs communs à tous sont valides
        $request->validate([
            'prenom'=>['required','string','max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'statut'=>['required','string','max:255'],
        ]);
        // Si le choix c'est Etudiant
        if(strcmp($request->statut,'Etudiant')==0){
           // On valide le numéro d'étudiant,l'université,la faculté et l'année
            $request->validate([
                'universite'=>['required'],
                'faculte'=>['required'],
                'numero_etudiant'=>['required'],
                'annee'=>['required'],
            ]);
            $student=Etudiant::create([
                'num_etudiant'=>$request->numero_etudiant,
                'annee'=>$request->annee,
            ]);
             $user = User::create([
                'prenom'=> $request->prenom,
                'nom' => $request->nom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'statut'=>$request->statut,
                'etudiant_id'=>$student->id,
            ]);
            $ma_fac=Faculte::find($request->faculte);
            $student->facultes()->attach($ma_fac);
        };




        if(strcmp($request->statut,'Entreprise')==0){ // Si c'est une entreprise, tu récupères le nom de l'entreprise, le job
            $request->validate([
                'entreprise'=>['required'],
            ]);

            if($request->fonction==NULL){
            $travailleur=Travailleur::create([
                'job'=>'non_renseigné',
            ]);
            }
            else{
                $travailleur=Travailleur::create([
                    'job'=>$request->fonction,
                ]);
            }
            $user = User::create([
                'prenom'=> $request->prenom,
                'nom' => $request->nom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'statut'=>$request->statut,
                'travailleur_id'=>$travailleur->id,
            ]);
            $mon_entreprise=Entreprise::find($request->entreprise);
            $travailleur->entreprises()->attach($mon_entreprise);

        }

        if(strcmp($request->statut,'Université')==0){
            $request->validate([
                'universite_univ'=>['required'],
                'faculte_univ'=>['required'],
                'fonction_univ'=>['required','string','max:255'],
            ]);
            $travailleur=Travailleur::create([
                'job'=>$request->fonction_univ,
            ]);
            $user=User::create([
                'prenom'=> $request->prenom,
                'nom' => $request->nom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'statut'=>$request->statut,
                'travailleur_id'=>$travailleur->id,
            ]);
            $mon_université=Université::find($request->universite_univ);
            $travailleur->universites()->attach($mon_université);

        }




        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    
}
