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
		<form method="POST" action="/upload_avenant/{{$convention->id}} " enctype="multipart/form-data">
			@csrf
			<div class=container>
				<div class=info>
					<div class=titre>
						Mon nouvel avenant
					</div>
					<div class=content>
						 @foreach ($errors->all() as $error)
               					 <li>{{ $error }}</li>
          					  @endforeach
								
						<div class=champs>
							<div class=texte-champs>
								Choisissez une procédure
							</div>
							<select id="procedure" name="procedure" "><option value=""> Choisissez une procédure </option>
							@foreach ($proc as $pro)
							<option value="{{$pro->id}}">
								{{$pro->nom_procedure}}
							</option>
							@endforeach
						</select>
					    </div>
					<div class=champs>
						<div class=texte-champs>
							Choisir une date de début
						</div>
						<input type="date" id="date_debut" name="date_debut"value="2018-07-22" required>
					</div>
					<div class=champs>
						<div class=texte-champs>
							Choisir une date de fin
						</div>
						<input type="date" id="date_fin" name="date_fin"value="2018-07-22" required>
					</div>
					<div class=champs>
						<div class=texte-champs>
							Avenant :
						</div>

					<input type="file" id="avenant" name="avenant" accept="pdf" required>
					
                    </div>
                   <div class=champs>
                        <button class=sub type=submit">	
					   <div class=button>
							Enregistrer
						</div>
                      </button>
                    </div>
					

					</form>
