<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title> Accueil </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo asset('css/register.css')?>" type="text/css"> 
        
</head>

<body>

<div class=container>

    <div class=form_container>
        <form>
            <h1 style="color:white; text-align:center;"> Formulaire d'inscription </h1>
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
            
            
            <div class=entry>
                Adresse:
            </div>
            <input type="text" placeholder="Entrer votre adresse" name="adresse" required>   
            
            <div class=entry>
                Statut:
            </div>
            <div class=containerofradio>
                <label for="etudiant" style="color:white">Etudiant</label>
                <input type="radio" id="etudiant" name="statut" value="Etudiant" checked/>
                <label for="entreprise" style="color:white">Entreprise</label>
                <input type="radio" id="entreprise" name="statut" value="Entreprise" />
                <label for="université" style="color:white">Université</label>
                <input type="radio" id="université" name="statut" value="Entreprise" />
            </div>

    



<div class=container_right>
        <div class=logo>
            <img src="/icone/logo_bleu.png" alt "logo" class="image_logo">
        </div>
</div>

</div>
@include('layout.footer')





</body>