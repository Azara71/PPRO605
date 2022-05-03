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
				Mes informations personnelles
			</div>
			<div class=content>
				<div class=champs>
					<div class=texte-champs>
						Prénom :
					</div>
					<div class=saisie-champs>
						Le prénom
					</div>


			</div>
				<div class=champs>
					<div class=texte-champs>
						Nom :
					</div>
					<div class=saisie-champs>
						Le nom
					</div>
				</div>

				<div class=champs>
					<div class=texte-champs>
						Nom utilisateur:
					</div>			
					<div class=saisie-champs>
						Le nom utilisateur
					</div>
				</div>
				<div class=champs>
				<div class=texte-champs>
						Mail:
				</div>	
				<div class=saisie-champs>
						Le mail
				</div>		
				</div>
				<div class=champs>
				<div class=texte-champs>
						Password :
				</div>
				<div class=saisie-champs>
						Le mot de passe
				</div>			
				</div>
				
				<div class=champs>
					<div class=texte-champs>
						Statut :
					</div>	
					<div class=saisie-champs>
						Le statut
				</div>	
				</div>
				<div class=buttons onclick="location.href='info_perso'">
					<div class=button>
						Editer
						@include('svg.stylo')
					</div>
					</div>		
			

			</div>

		</div>
	</div>
	@include('layout.logo')





	@include ('layout.footer')



</body>