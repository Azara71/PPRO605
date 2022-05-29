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
    <?php echo $__env->make('layout.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class=container_convention>
         
    
      

        <?php $__currentLoopData = $conventions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $convention): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <div class=convention>
            <div class=titre>
                  <?php echo e($convention->procedure->procedure_modele->nom_procedure); ?>

            </div>
            <div class=content>
                <div class=description>
                   <p><?php echo e($convention->description); ?></p>
                </div>
                <div class=info_complémentaire>
                                
                            <div class=tuteur>
                            <?php echo e($convention->tuteur->nom); ?>

                            </div>
                               <div class=tuteur>
                            Date de création :  <?php echo e($convention->date_creation); ?>

                            </div>
                             <div class=tuteur>
                            Modifiée le : <?php echo e($convention->date_derniere_modification); ?>

                            </div>
                            <div class=tuteur>
                            <?php if($convention->procedure->num_etape <= $convention->procedure->nombre_etapes_max): ?>
                            Etapes : <?php echo e($convention->procedure->num_etape); ?> / <?php echo e($convention->procedure->nombre_etapes_max); ?> 
                           <div class=tuteur>
                            Etat : En Cours
                            </div>
                            <?php else: ?>
                            Etapes : Fini
                            
                            <?php endif; ?>
                            </div>
                         
                           <div class=buttons-list>
                                <?php if($convention->procedure->num_etape<=$convention->procedure->nombre_etapes_max): ?>
                               <div class=voir onclick="location.href='mes_conventions/edit_convention/<?php echo e($convention->id); ?>'">
                                   <?php echo $__env->make('svg.stylo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                <?php else: ?> 
                                 <div class=ajout_avenant onclick="location.href='mes_conventions/voir_avenants/<?php echo e($convention->id); ?>'">
                                 Voir les avenants
                                   <?php echo $__env->make('svg.add_etudiant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                



                                <?php endif; ?>
                               <div class=voir onclick="location.href='mes_conventions/dl/<?php echo e($convention->id); ?>'">
	                                <?php echo $__env->make('svg.dl', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                               </div>
                             </div>
                </div>
          </div>
        </div>
                  

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            

          <?php if(Auth::user()->statut=='Etudiant'): ?>
        <div class=convention_plus onclick="location.href='mes_conventions/create';">
           <div class=plus >
              <?php echo $__env->make('svg.plus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
        <?php endif; ?>
      
        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body><?php /**PATH C:\laragon\www\PPRO605\resources\views/mes_conventions.blade.php ENDPATH**/ ?>