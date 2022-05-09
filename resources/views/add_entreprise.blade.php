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


    

</body>

@include('layout.navbar')


<form method="post" action="{{route('ajout_entreprise')}}">
@csrf
	<div class=container>
		<div class=info>
			<div class=titre>
				Ajout d'une entreprise
			</div>
            <div class=content>
            <div class=champs>
					<div class=texte-champs>
						Nom de l'entreprise :
					</div>
				
						<input type="text" placeholder="Nom de l'entreprise" name="nom_entreprise" >
    
                      
    
			</div>
            <div class=champs>
            <div class=texte-champs>
						Numéro de siret de l'entreprise
					</div>
				
						<input type="text" placeholder="Ex : 123 568 941 00056" name="num_siret" >
            </div>

            <div class=champs>
            <div class=texte-champs>
						Adresse de l'entreprise
					</div>
				
						<input type="text" placeholder="Ex : 9464 Johnston Circle" name="adresse_entreprise" >
            </div>
            <button class=sub type=submit">	<div class=button>
						Enregistrer
						@include('svg.stylo')
				</div>
            </button>

            </div>
        
            </div>
    </div>


   
</form>


</html>