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
				Ma nouvelle convention
			</div>
			<div class=content>
                <div class=champs>



            </div>
    </body>