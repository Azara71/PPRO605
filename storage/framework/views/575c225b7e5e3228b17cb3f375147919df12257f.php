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


    

</body>

<?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<form method="post" action="<?php echo e(route('ajout_entreprise')); ?>">
<?php echo csrf_field(); ?>
	<div class=container>
		<div class=info>
			<div class=titre>
				Ajout d'une entreprise
			</div>
            <div class=content>
            <div class=champs>
					<div class=texte-champs>
						Nom de l'entreprise :
					</div>
				
						<input type="text" placeholder="Nom de l'entreprise" name="nom_entreprise" >
    
                      
    
			</div>
            <div class=champs>
            <div class=texte-champs>
						Numéro de siret de l'entreprise
					</div>
				
						<input type="text" placeholder="Ex : 123 568 941 00056" name="num_siret" >
            </div>

            <div class=champs>
            <div class=texte-champs>
						Adresse de l'entreprise
					</div>
				
						<input type="text" placeholder="Ex : 9464 Johnston Circle" name="adresse_entreprise" >
            </div>
            <button class=sub type=submit">	<div class=button>
						Enregistrer
						<?php echo $__env->make('svg.stylo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
            </button>

            </div>
        
            </div>
    </div>


   
</form>


</html><?php /**PATH C:\laragon\www\PPRO605\resources\views/add_entreprise.blade.php ENDPATH**/ ?>