<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
		<link rel="stylesheet" href="<?php echo asset('css/liste_etudiant.css')?>" type="text/css">

    </head>

    <body>
        
        @include('layout.navbar')
<div class=content>
 <table>
    <tr>
        <th scope="col">Prenom</th>
        <th scope="col">Nom</th>
        <th scope="col">Adresse Mail</th>
        <th scope="col">Numéro étudiant</th>
        <th scope="col">Année d'étude</th>
    </tr>
   
    @foreach ($etudiants as $etudiant)
    <tr>
        <td>{{$etudiant->prenom}}</td>
        <td>{{$etudiant->nom}}</td>
        <td>{{$etudiant->email}}</td>
        <td>{{$info_etudiants[$loop->iteration-1]->num_etudiant}}</td>
        <td>{{$info_etudiants[$loop->iteration-1]->annee}}</td>

    </tr>
    @endforeach
</table>

     @foreach ($errors->all() as $error)
               					 <li>{{ $error }}</li>
        @endforeach
    <form method="post" action="{{route('ajout_etudiants_csv')}}" enctype="multipart/form-data" class="form_add">
        @csrf
      
    <div class="depot">
            
    <label for="file" class="label-file">Choisir un fichier csv @include('svg.dl')</label>
    </div>
    <input id="file" class="input-file" type="file" name="file" accept=".csv" required>

    <button type="submit" class="import_button"> Valider </button>
    </form>


</div>

    </body>

</html>