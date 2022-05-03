<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
		<link rel="stylesheet" href="<?php echo asset('css/contact.css')?>" type="text/css">
    
	</head>
	<body>

    @include('layout.navbar')
	@include('layout.logo')
	<div class="container">
		<div class="titre">
			MESSAGE :
		</div>
		<div class="formulaire_de_demande">
			<form>
				<textarea>mama</textarea>
			</form>
		</div>
	</div>





	@include('layout.footer')
  

</body>