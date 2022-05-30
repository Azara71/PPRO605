<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo asset('css/info_perso.css')?>" type="text/css">

    
	</head>

    <body>
    @include('layout.navbar')
   
    <div class=container>
		<div class=info>
			<div class=titre>
				Les différentes procédures existantes :
			</div>
            <div class=content>

             @foreach ($procedures as $procedure)
             <div class=champs>
                 {{$procedure->nom_procedure}} : 
            <div class=saisie-champs>
               Nombre étapes : {{$procedure->nombre_etapes_max}}
			</div>
            </div>

             @endforeach
             <button type="submit" class="import_button" onclick="location.href='creer_procedure'"> Créer une procédure </button>

            </div>

    </div>
    </div>


    </body>
</html>