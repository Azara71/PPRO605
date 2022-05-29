<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
		<link rel="stylesheet" href="<?php echo asset('css/info_perso.css')?>" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	</head>
	<script type="text/javascript">

			$(document).ready(function () {
            $('#entreprise_selection').on('change', function () {
                var entrepriseId = this.value;
                $('#job').html('');
                $.ajax({
                    url: '<?php echo e(route('getJobs')); ?>?ent_id='+entrepriseId,
                    type: 'get',
                    success: function (res) {
                        $('#job').html('<option value="">Selectionnez un job</option>');
                        $.each(res, function (key, value) {
                            $('#job').append('<option value="' + value
                                .id + '">' + value.nom_job + '</option>');
                        });
                    }
                });
            });
		});
</script>
	<body>

    <?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<form method="post" action="<?php echo e(route('modify',Auth::user()->id)); ?>">
	<?php echo csrf_field(); ?>
	<div class=container>
		<div class=info>
			<div class=titre>
				Mes informations personnelles
			</div>
			<div class=content>
				<div class=champs>
					<div class=texte-champs>
						Prénom :
					</div>
					<div class=saisie-champs>
						<input type="text" placeholder="<?php echo e(Auth::user()->prenom); ?>" name="prenom" >
					</div>
			</div>
				<div class=champs>
					<div class=texte-champs>
						Nom :
					</div>
					<div class=saisie-champs>
					<input type="text" placeholder="<?php echo e(Auth::user()->nom); ?>" name="nom" >
					</div>
				</div>

				
				<div class=champs>
				<div class=texte-champs>
						Mail:
				</div>	
				<div class=saisie-champs>
					<?php echo e(Auth::user()->email); ?>

				</div>		
				</div>
		
				
				<div class=champs>
					<div class=texte-champs>
						Statut :
					</div>	
					<div class=saisie-champs>
					<?php echo e(Auth::user()->statut); ?>


				</div>	
				</div>

				<?php if(Auth::user()->statut=='Etudiant'): ?>
				<div class=champs>
					<div class=texte-champs>
					Faculté : 
					</div>
					<div class=saisie-champs>
					<?php echo e(Auth::user()->etudiant->facultes[0]->nom_faculte); ?>	
					</div>
				</div>
				<div class=champs>
					<div class=texte-champs>
					Université : 
					</div>
					<div class=saisie-champs>
					<?php echo e(Auth::user()->etudiant->facultes[0]->universite->nom_université); ?>	
					</div>
				</div>

				<?php endif; ?>

				<?php if(Auth::user()->statut=='Entreprise'): ?>
				<?php if(Auth::user()->travailleur->job_id!=NULL): ?> 
				<div class=champs>
					<div class=texte-champs>
						Entreprise :
					</div>	
					<div class=saisie-champs>
						<?php echo e(Auth::user()->travailleur->entreprises[0]->nom_entreprise); ?>

					</div>
				</div>	
				<div class=champs>
					<div class=texte-champs>
						Emploi dans l'entreprise : 
					</div>	
					<div class=saisie-champs>
						<?php echo e(Auth::user()->travailleur->job->nom_job); ?>

					</div>
				</div>	
				<?php endif; ?>
				
				<?php if(Auth::user()->travailleur->job==NULL): ?>
				<div class=champs>
					<div class=texte-champs>
						Choisissez une entreprise :
					</div>	
					<div class=saisie-champs>
						
					<select id="entreprise_selection" name="entreprise" ">
					<?php $__currentLoopData = $entreprise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entreprise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($entreprise->id); ?>"><?php echo e($entreprise->nom_entreprise); ?> - <?php echo e($entreprise->num_siret); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
					<a href="/add_entreprise" class="btn btn-primary">Ajoutez une entreprise...</a>
				</div>
				</div>	
			
				<div class=entry id="name">Job :</div>
				<div class="custom-select">
				<select id="job" name="job">
					<option value="" class=opt>Choisissez une entreprise...</option>
				</select>
				</div>
				<?php endif; ?>
			<?php endif; ?>


				<?php if(Auth::user()->statut=='Université'): ?>
				<div class=champs>
					<div class=texte-champs>
						Statut à l'université :
					</div>	
					<div class=saisie-champs>
					<?php echo e(Auth::user()->travailleur->job->nom_job); ?> 
					</div>
				</div>	
				<div class=champs>
					<div class=texte-champs>
					Université : 
					</div>
					<div class=saisie-champs>
					<?php echo e(Auth::user()->travailleur->facultes[0]->universite->nom_université); ?>	
					</div>
				</div>
				<div class=champs>
					<div class=texte-champs>
					Faculté : 
					</div>
					<div class=saisie-champs>
					<?php echo e(Auth::user()->travailleur->facultes[0]->nom_faculte); ?>	
					</div>
				</div>
				


				<?php endif; ?>
				<div class=champs>
					<div class=texte-champs>
					Acces : 
					</div>
					<div class=saisie-champs>
					<?php echo e(Auth::user()->acces->Description); ?>	
					</div>
				</div>
				<button class=sub type=submit">	<div class=button>
						Enregistrer
						<?php echo $__env->make('svg.stylo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
</button>
				
				</div>		
			

			</div>

		</div>
	</div>
</form>
	<?php echo $__env->make('layout.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>





	<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



</body><?php /**PATH C:\laragon\www\PPRO605\resources\views/info_perso.blade.php ENDPATH**/ ?>