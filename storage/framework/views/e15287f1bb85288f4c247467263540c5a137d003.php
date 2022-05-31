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
             <div class=etapes>
                    <?php $__currentLoopData = $etapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->iteration==$procedure->num_etape): ?>
                    <div class=circleended>
                        <?php echo e($loop->iteration); ?> 
                        
                    </div>
                    <?php elseif($loop->iteration>$procedure->num_etape): ?>
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
       <form method="POST" action="/public/maj_convention/<?php echo e($convention[0]->id); ?>" enctype="multipart/form-data">
			<?php echo csrf_field(); ?>
			<div class=container>
               
				<div class=info>
					<div class=titre>
						Modifier ma convention.
					</div>
            
					<div class=content>
                        <?php if($procedure->num_etape<=1 ): ?>
                            <?php if(Auth::user()->acces->Description=='Etudiant'): ?>
                                  Vous pouvez modifier cette convention jusqu'à ce que la première étape soit terminée.
                                
                                  
                                  <div class=champs>
								     <div class=texte-champs >
									    Description de la convention
								     </div>
								    <input type="text" id="description" name="description" placeholder="<?php echo e($convention[0]->description); ?>" required>
						          </div>
                                  <div class=champs>
                                        <div class=texte-champs>
                                          Mettre à jour sa convention :
                                        </div>
                                  	<input type="file" id="convention" name="convention" accept="pdf" required>
                                  </div>
                                
                            <?php else: ?>    <!-- SI NON ETUDIANT -->
                            <div class=champs>
								     <div class=texte-champs >
									    Description de la convention :
								     </div>
								     <?php echo e($convention[0]->description); ?>     
						    </div>
                            <div class=champs>
								     <div class=texte-champs >
									    Date de création :
								     </div>
								        <?php echo e($convention[0]->date_creation); ?> 
						    </div>
                             <div class=champs>
								     <div class=texte-champs >
									    Date de dernière modification :
								     </div>
								        <?php echo e($convention[0]->date_derniere_modification); ?> 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									      Date de début :
								     </div>
								        <?php echo e($convention[0]->date_debut); ?> 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									     Date de fin :
								     </div>
								        <?php echo e($convention[0]->date_fin); ?> 
						     </div>
                             <?php endif; ?> 

                        <?php else: ?> <!--SI ON EST PAS A L'ETAPE 1-->
                           <div class=champs>
								     <div class=texte-champs >
									    Description de la convention :
								     </div>
								     <?php echo e($convention[0]->description); ?>     
						    </div>
                            <div class=champs>
								     <div class=texte-champs >
									    Date de création :
								     </div>
								        <?php echo e($convention[0]->date_creation); ?> 
						    </div>
                             <div class=champs>
								     <div class=texte-champs >
									    Date de dernière modification :
								     </div>
								        <?php echo e($convention[0]->date_derniere_modification); ?> 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									      Date de début :
								     </div>
								        <?php echo e($convention[0]->date_debut); ?> 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									     Date de fin :
								     </div>
								        <?php echo e($convention[0]->date_fin); ?> 
						     </div>
                            <?php endif; ?>




                            
                   
                        <?php if(Auth::user()->acces==$etape_acces): ?>
                             
                                  <div class=champs>
                                        <div class=texte-champs>
                                        Mettre à jour la convention
                                        </div>
                                  	<input type="file" id="convention" name="convention" accept="pdf" required>
                                  </div>
                                  	<div class=texte-champs>
					   <button class=sub type=submit">	
					   <div class=button>
                                          Passer à l'étape suivante :
						</div>
						</div>
            			</button>

                           
                        <?php else: ?>
                        <div class="">Etape en attente de validation.</div>           
                        <?php endif; ?>
                    </div>
                </div>
             
            </div>
        </form>
       
    



   <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html><?php /**PATH C:\laragon\www\PPRO605\resources\views/edit_convention.blade.php ENDPATH**/ ?>