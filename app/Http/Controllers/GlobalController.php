<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;



class GlobalController extends Controller{
    // Controle de l'accueil
    public function accueil()
    {  
       // $test=Etudiant::all();
        return view('accueil');//,compact('test'));
    }

    // Controle de l'enregistrement
    public function register()
    {
        return view('register');
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