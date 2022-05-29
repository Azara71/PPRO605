<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
		<link rel="stylesheet" href="<?php echo asset('css/contact.css')?>" type="text/css">
    
	</head>
	<body>

    <?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('layout.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="container">
		<div class="titre">
			MESSAGE :
		</div>
		<div class="formulaire_de_demande">
			<form>
				<textarea>mama</textarea>
			</form>
		</div>
	</div>





	<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  

</body><?php /**PATH C:\laragon\www\PPRO605\resources\views/contact.blade.php ENDPATH**/ ?>