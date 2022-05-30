<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <title> Accueil </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo asset('css/accueil.css')?>" type="text/css"> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Libre+Bodoni:ital@1&display=swap" rel="stylesheet">
</head>

<body>
<div class=container>
    <div class=container_left>
        <div class=dialogue>
           Bienvenue,vous voici maintenant sur le portail de mise en place et de suivi de conventions de stages, afin de poursuivre, nous vous demanderons, de vous connecter.
        </div>
        <div class=buttons>
            <div class=register>
               <a href="register" class=texte_register>
                    S'enregistrer
                </a>
            </div>
            <div class=connexion>
                <a href="login" class=texte_connexion>
                    Se connecter
                </a>
            </div>

        </div>
       
        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>  

    <div class=container_right>
        <div class=logo>
            <img src="/icone/logo_bleu.png" alt "logo" class="image_logo">


        </div>
    </div>
    



</div>

</body>

</html><?php /**PATH C:\laragon\www\PPRO605\resources\views/accueil.blade.php ENDPATH**/ ?>