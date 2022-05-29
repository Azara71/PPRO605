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
		<form method="POST" action="/upload_avenant/<?php echo e($convention->id); ?> " enctype="multipart/form-data">
			<?php echo csrf_field(); ?>
			<div class=container>
				<div class=info>
					<div class=titre>
						Mon nouvel avenant
					</div>
					<div class=content>
						 <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               					 <li><?php echo e($error); ?></li>
          					  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								
						<div class=champs>
							<div class=texte-champs>
								Choisissez une procédure
							</div>
							<select id="procedure" name="procedure" "><option value=""> Choisissez une procédure </option>
							<?php $__currentLoopData = $proc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($pro->id); ?>">
								<?php echo e($pro->nom_procedure); ?>

							</option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					    </div>
					<div class=champs>
						<div class=texte-champs>
							Choisir une date de début
						</div>
						<input type="date" id="date_debut" name="date_debut"value="2018-07-22" required>
					</div>
					<div class=champs>
						<div class=texte-champs>
							Choisir une date de fin
						</div>
						<input type="date" id="date_fin" name="date_fin"value="2018-07-22" required>
					</div>
					<div class=champs>
						<div class=texte-champs>
							Avenant :
						</div>

					<input type="file" id="avenant" name="avenant" accept="pdf" required>
					
                    </div>
                   <div class=champs>
                        <button class=sub type=submit">	
					   <div class=button>
							Enregistrer
						</div>
                      </button>
                    </div>
					

					</form>
<?php /**PATH C:\laragon\www\PPRO605\resources\views/create_avenant.blade.php ENDPATH**/ ?>