<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo asset('css/info_perso.css')?>" type="text/css">

    
	</head>

    <body>
    <?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
    <div class=container>
		<div class=info>
			<div class=titre>
				Les différentes procédures existantes :
			</div>
            <div class=content>

             <?php $__currentLoopData = $procedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <div class=champs>
                 <?php echo e($procedure->nom_procedure); ?> : 
            <div class=saisie-champs>
               Nombre étapes : <?php echo e($procedure->nombre_etapes_max); ?>

			</div>
            </div>

             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <button type="submit" class="import_button" onclick="location.href='creer_procedure'"> Créer une procédure </button>

            </div>

    </div>
    </div>


    </body>
</html><?php /**PATH C:\laragon\www\PPRO605\resources\views/procedures.blade.php ENDPATH**/ ?>