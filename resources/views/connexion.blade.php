<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title> Connexion </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo asset('css/register.css')?>" type="text/css"> 
        
</head>

<body>

<div class=form_container>
                <form>
					<h1 style="color:white; text-align:center;"> Formulaire de connexion </h1>
                    <div class=entry>
						Nom d'utilisateur :
					</div>
					<input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
					<div class=entry>
						Mot de passe :
					</div>
					<input type="text" placeholder="Entrer le mail" name="mail" required>
					<div class=entry>
						Mail :
					</div>
					<input type="text" placeholder="Entrer le mot de passe" name="password" required>
                    <input type="button" class="button" value="Je souhaite me connecter."  onclick="location.href='main';">

                </form>
</div>











<!-- LOGO -->
<div class=container_right>
        <div class=logo>
            <img src="/icone/logo_bleu.png" alt "logo" class="image_logo">
        </div>
    </div>

</body>



<!-- FOOTER -->
@include('layout.footer')
</html>