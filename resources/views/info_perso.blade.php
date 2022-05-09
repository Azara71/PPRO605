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
	<form method="post" action="{{route('modify',Auth::user()->id)}}">
	@csrf
	<div class=container>
		<div class=info>
			<div class=titre>
				Mes informations personnelles
			</div>
			<div class=content>
				<div class=champs>
					<div class=texte-champs>
						Prénom :
					</div>
					<div class=saisie-champs>
						<input type="text" placeholder="{{Auth::user()->prenom}}" name="prenom" >
					</div>


			</div>
				<div class=champs>
					<div class=texte-champs>
						Nom :
					</div>
					<div class=saisie-champs>
					<input type="text" placeholder="{{Auth::user()->nom}}" name="nom" >
					</div>
				</div>

				
				<div class=champs>
				<div class=texte-champs>
						Mail:
				</div>	
				<div class=saisie-champs>
					{{Auth::user()->email}}
				</div>		
				</div>
		
				
				<div class=champs>
					<div class=texte-champs>
						Statut :
					</div>	
					<div class=saisie-champs>
					{{Auth::user()->statut}}

				</div>	
				</div>

				@if(Auth::user()->statut=='Etudiant')
				{{Auth::user()->statut}}
				@endif

				@if(Auth::user()->statut=='Entreprise')
				{{Auth::user()->statut}}
				@endif

				@if(Auth::user()->statut=='Université')
				<div class=champs>
					<div class=texte-champs>
						Job :
					</div>	
					<div class=saisie-champs>
					{{Auth::user()->travailleur->job}}
					</div>
				</div>	
					
				@endif
				<button class=buttons type=submit">	<div class=button>
						Enregistrer
						@include('svg.stylo')
				</div>
				</button
				
					</div>		
			

			</div>

		</div>
	</div>
</form>
	@include('layout.logo')





	@include ('layout.footer')



</body>