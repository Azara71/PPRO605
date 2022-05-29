<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo asset('css/convention.css')?>" type="text/css">

    
	</head>

    <body>
    <?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

     <div class=container_convention>
         
        <?php $__currentLoopData = $avenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class=convention>
            <div class=titre>
            AVENANT
            </div>
          

            <div class=content>
                <div class=description>
                   <p><?php echo e($convention->description); ?></p>
                </div>
                <div class=info_complémentaire>

                 <div class=tuteur>
                     Date de début: <?php echo e($avenant->date_debut); ?>

                 </div>
                 <div class=tuteur>
                     Date de fin: <?php echo e($avenant->date_fin); ?>

                 </div>
                    
                    <?php if($avenant->procedure->num_etape<=$avenant->procedure->nombre_etapes_max): ?>
                    <div class=tuteur>

                    Etat de la procédure : En cours... 
                     </div>
                    <?php echo e($avenant->procedure->num_etape); ?> / <?php echo e($avenant->procedure->nombre_etapes_max); ?>

                    <?php else: ?>
                    <div class=tuteur>
                     Etat de la procédure: Fini... 
                     </div>
                
                 
                 <?php endif; ?>

                 
                <div class=buttons-list>
                      <div class=ajout_avenant onclick="location.href='/mes_conventions/avenant/<?php echo e($avenant->id); ?>'">
                                 Voir la procédure de l'avenant
                      </div>
                       <div class=voir onclick="location.href='/mes_conventions/dl_avenant/<?php echo e($avenant->id); ?>'">
	                                <?php echo $__env->make('svg.dl', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                </div>
                


                 </div>



            </div>
           

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php if(Auth::user()->statut=='Etudiant'): ?>
        <div class=convention_plus onclick="location.href='/mes_conventions/<?php echo e($convention->id); ?>/avenant/create';">
           <div class=plus >
              <?php echo $__env->make('svg.plus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
        <?php endif; ?>
    </div>


    </body>
</html><?php /**PATH C:\laragon\www\PPRO605\resources\views/avenants.blade.php ENDPATH**/ ?>