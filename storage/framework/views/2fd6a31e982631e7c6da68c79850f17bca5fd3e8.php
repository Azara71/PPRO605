
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
        	 <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               					 <li><?php echo e($error); ?></li>
          					  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <div class=etapes>
                    <?php $__currentLoopData = $avenant->procedure->etapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->iteration==$avenant->procedure->num_etape): ?>
                    <div class=circleended>
                        <?php echo e($loop->iteration); ?> 
                        
                    </div>
                    <?php elseif($loop->iteration>$avenant->procedure->num_etape): ?>
                    <div class=circletodo>
                        <?php echo e($loop->iteration); ?> 
                    </div>
                    <?php else: ?> 
                    <div class=circledone>
                          <?php echo e($loop->iteration); ?> 
                    </div>
                    <?php endif; ?>
                    <div class=explication_etape>
                        <?php echo e($etape->description); ?>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
    
     <form method="POST" action="<?php echo e(route('maj_avenant',[$avenant->id])); ?>" enctype="multipart/form-data">
			<?php echo csrf_field(); ?>
			<div class=container>
               
				<div class=info>
					<div class=titre>
						Modifier ma convention.
					</div>
                    <div class=content>
                              <div class=champs>
								     <div class=texte-champs >
									    Date de création :
								     </div>
								        <?php echo e($avenant->created_at); ?> 
						    </div>
                             <div class=champs>
								     <div class=texte-champs >
									    Date de dernière modification :
								     </div>
								        <?php echo e($avenant->updated_at); ?> 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									      Date de début :
								     </div>
								        <?php echo e($avenant->date_debut); ?> 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									     Date de fin :
								     </div>
								        <?php echo e($avenant->date_fin); ?> 
						     </div>
                        
                        <?php if(Auth::user()->acces->id==$avenant->procedure->etapes[$avenant->procedure->num_etape-1]->etape_modele->acces->id): ?>
                          <div class=champs>
                                        <div class=texte-champs>
                                        Mettre à jour l'avenant
                                        </div>
                                  	<input type="file" id="avenant" name="avenant" accept="pdf" required>
                          </div>
                          <div class=texte-champs>
					         <button class=sub type=submit">	
					         <div class=button>
                             Passer à l'étape suivante :
						     </div>
						  </div>
                        <?php else: ?> 
                        Ce n'est pas encore à vous de faire avancer la procédure...
                        <?php endif; ?>

                    </div>
                </div>
            </div>
     </form>
    </body>
</html>
<?php /**PATH C:\laragon\www\PPRO605\resources\views/avenant.blade.php ENDPATH**/ ?>