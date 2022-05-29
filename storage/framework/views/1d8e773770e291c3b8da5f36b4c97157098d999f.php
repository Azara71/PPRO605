<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo asset('css/register.css')?>" type="text/css">
<script type="text/javascript">
        $(document).ready(function () {
            $('#university_selection').on('change', function () {
                var universityId = this.value;
                $('#fac').html('');
                $.ajax({
                    url: '<?php echo e(route('getFacs')); ?>?univ_id='+universityId,
                    type: 'get',
                    success: function (res) {
                        $('#fac').html('<option value="">Selectionnez une faculté</option>');
                        $.each(res, function (key, value) {
                            $('#fac').append('<option value="' + value
                                .id + '">' + value.nom_faculte + '</option>');
                        });
                    }
                });
            });
		});
		$(document).ready(function () {
            $('#university_two_selection').on('change', function () {
                var universityId = this.value;
                $('#fac_two').html('');
                $.ajax({
                    url: '<?php echo e(route('getFacs')); ?>?univ_id='+universityId,
                    type: 'get',
                    success: function (res) {
                        $('#fac_two').html('<option value="">Selectionnez une faculté</option>');
                        $.each(res, function (key, value) {
                            $('#fac_two').append('<option value="' + value
                                .id + '">' + value.nom_faculte + '</option>');
                        });
                    }
                });
            });
		});
		$(document).ready(function () {
            $('#entreprise_selection').on('change', function () {
                var entrepriseId = this.value;
                $('#job_selection').html('');
                $.ajax({
                    url: '<?php echo e(route('getJobs')); ?>?ent_id='+entrepriseId,
                    type: 'get',
                    success: function (res) {
                        $('#job_selection').html('<option value="">Selectionnez une fonction</option>');
                        $.each(res, function (key, value) {
                            $('#job_selection').append('<option value="' + value
                                .job_id + '">' + value.nom_job + '</option>');
                        });
                    }
                });
            });
		});
		$(document).ready(function () {
            $('#fac_two').on('change', function () {
                var facId = this.value;
                $('#fonction_univ').html('');
                $.ajax({
                    url: '<?php echo e(route('getJobs')); ?>?fac_id='+facId,
                    type: 'get',
                    success: function (res) {
                        $('#fonction_univ').html('<option value="">Selectionnez une fonction</option>');
                        $.each(res, function (key, value) {
                            $('#fonction_univ').append('<option value="' + value
                                .job_id + '">' + value.nom_job + '</option>');
                        });
                    }
                });
            });
		});


			function cacher(entry_to_hide){
				entry_to_hide.style.display="none";
				var All = entry_to_hide.getElementsByTagName("input");
				for (var i=0;
				i<All.length;
				i++) {
					try {
						All[i].value="";
					}
					catch (e) {
					}
				}
				var All = entry_to_hide.getElementsByTagName("select");
				for (var i=0;
				i<All.length;
				i++) {
					try {
						All[i].value="";
					}
					catch (e) {
					}
				}
				
				
			}
			function apparaitre(entry_to_hide){
				entry_to_hide.style.display="block";
			}
			function ShowHideDiv(radio_validated){
				var radio_etudiant = document.getElementById("radio_validated");
				if(radio_validated==="etudiant"){
					var entry_to_hide = document.getElementById("saisie_université");
					cacher(entry_to_hide);
					var entry_to_hide = document.getElementById("saisie_entreprise");
					cacher(entry_to_hide);
					var entry_to_appear=document.getElementById("saisie_etudiant");
					apparaitre(entry_to_appear);
				}
				if(radio_validated==="entreprise"){
					var entry_to_hide = document.getElementById("saisie_etudiant");
					cacher(entry_to_hide);
					var entry_to_hide = document.getElementById("saisie_université");
					cacher(entry_to_hide);
					var entry_to_appear=document.getElementById("saisie_entreprise");
					apparaitre(entry_to_appear);
				}
				if(radio_validated==="université"){
					var entry_to_hide = document.getElementById("saisie_etudiant");
					cacher(entry_to_hide);
					var entry_to_hide = document.getElementById("saisie_entreprise");
					cacher(entry_to_hide);
					var entry_to_appear=document.getElementById("saisie_université");
					apparaitre(entry_to_appear);
				}
			}
		</script>

		<div class=container>
			<div class=form_container>
       
        <!-- Validation Errors -->
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.auth-validation-errors','data' => ['class' => 'mb-4','errors' => $errors]]); ?>
<?php $component->withName('auth-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-4','errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

        <form method="POST"  action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>
			<h1 style="color:white; text-align:center;"> Formulaire d'inscription </h1>
            <!-- Name -->
            <div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.label','data' => ['for' => 'prénom','value' => __('Prénom'),'style' => 'color:white']]); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'prénom','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Prénom')),'style' => 'color:white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.input','data' => ['id' => 'prénom','class' => 'block mt-1 w-full','type' => 'text','name' => 'prenom','value' => old('prenom'),'required' => true,'autofocus' => true]]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'prénom','class' => 'block mt-1 w-full','type' => 'text','name' => 'prenom','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('prenom')),'required' => true,'autofocus' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>

			<div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.label','data' => ['for' => 'nom','value' => __('Nom')]]); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'nom','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Nom'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.input','data' => ['id' => 'nom','class' => 'block mt-1 w-full','type' => 'text','name' => 'nom','value' => old('nom'),'required' => true,'autofocus' => true]]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'nom','class' => 'block mt-1 w-full','type' => 'text','name' => 'nom','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('nom')),'required' => true,'autofocus' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>


            <!-- Email Address -->
            <div class="mt-4">
				
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.label','data' => ['for' => 'email','value' => __('Email')]]); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Email'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.input','data' => ['id' => 'email','class' => 'block mt-1 w-full','type' => 'email','name' => 'email','value' => old('email')]]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'email','class' => 'block mt-1 w-full','type' => 'email','name' => 'email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('email'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.label','data' => ['for' => 'password','value' => __('Password')]]); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'password','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Password'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.input','data' => ['id' => 'password','class' => 'block mt-1 w-full','type' => 'password','name' => 'password','required' => true,'autocomplete' => 'new-password']]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'password','class' => 'block mt-1 w-full','type' => 'password','name' => 'password','required' => true,'autocomplete' => 'new-password']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.label','data' => ['for' => 'password_confirmation','value' => __('Confirm Password')]]); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'password_confirmation','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Confirm Password'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.input','data' => ['id' => 'password_confirmation','class' => 'block mt-1 w-full','type' => 'password','name' => 'password_confirmation','required' => true]]); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'password_confirmation','class' => 'block mt-1 w-full','type' => 'password','name' => 'password_confirmation','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
			<!-- Choix entre entreprise, étudiant et université-->
			<div class=containerofradio>
				<label for="etudiant" style="block text-gray-700">Etudiant</label><input type="radio" id="etudiant" name="statut" value="Etudiant" checked onclick="ShowHideDiv('etudiant')"/>
				<label for="entreprise" style="block text-gray-700">Entreprise</label><input type="radio" id="entreprise" name="statut" value="Entreprise" onclick="ShowHideDiv('entreprise')"/>
				<label for="université" style="block text-gray-700">Université</label><input type="radio" id="université" name="statut" value="Université" onclick="ShowHideDiv('université')"/>
			</div>
		<!--Saisie visible que si étudiant-->
		<div id="saisie_etudiant">
				<div class=entry id="name">Université :</div>
				
				<div class="custom-select">
				<select  id="university_selection" name="universite" >
					<option value="">Choisissez une université...</option>
					<?php $__currentLoopData = $univs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $univ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($univ->id); ?>"><?php echo e($univ->nom_université); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
				</select>
				</div>

				<div class=entry >Faculté :</div>

				<div class="custom-select">
				<select id="fac" name="faculte">
					<option value="" class=opt>Choisissez un UFR...</option>
				
				</select>
				</div>
				<div class=entry >Année :</div>
				<div class="custom-select">
					<select id="annee_selection" name="annee">
						<option value="" class=opt>Choisissez une année ...</option>
						<option value="L1">L1</option>
						<option value="L2">L2</option>
						<option value="L3">L3</option>
					</select>
				</div>
				<div class=entry>Numéro d'étudiant:</div>
					<input type="text" placeholder="Rentrer votre numéro d'étudiant" id="numero_etudiant" name="numero_etudiant" >
						  <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.button','data' => ['class' => 'ml-4']]); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'ml-4']); ?>
                    <?php echo e(__('Register')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
			
				</div>
				 
			





			<!--Saisie visible que si entreprise-->
			<div id="saisie_entreprise" style="display:none;">
				<div class=entry id="name">Entreprise :</div>
				
				<div class="custom-select">
				<select id="entreprise_selection" name="entreprise" >
					<option value="" class=opt>Choisissez une entreprise...</option>
					<?php $__currentLoopData = $entreprise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($ent->id); ?>"><?php echo e($ent->nom_entreprise); ?> - <?php echo e($ent->num_siret); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<option value="Aucune" class=opt >Mon entreprise ne figure pas dans la liste...</option>
				</select>
				</div>

				<div class=entry id="name">Fonction :</div>
				<div class="custom-select">
				<select id="job_selection" name="fonction">
					<option value="" class=opt>Choisissez une entreprise...</option>
					
				
				</select>

				</div>
				 <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.button','data' => ['class' => 'ml-4']]); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'ml-4']); ?>
                    <?php echo e(__('Register')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
			</div>

				<!--Saisie visible que si université-->
				<div id="saisie_université" style="display:none;">
				<div class=entry id="name">Université :</div>
				
				<div class="custom-select">
				<select  id="university_two_selection" name="universite_univ" >
					<option value="">Choisissez une université...</option>
					<?php $__currentLoopData = $univs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $univ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($univ->id); ?>"><?php echo e($univ->nom_université); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
				</select>
					
						 
				</div>
				<div class=entry >Faculté :</div>

<div class="custom-select">
<select id="fac_two" name="faculte_univ" >
	<option value="" class=opt>Choisissez un UFR...</option>

</select>
</div>
<div class="custom-select">
<div class=entry >Fonction à l'université :</div>

<select id="fonction_univ" name="fonction_univ" >
	<option value="" class=opt>Choisissez une fonction</option>

</select>
</div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="<?php echo e(route('login')); ?>">
                    <?php echo e(__('Already registered?')); ?>

                </a>
			
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.button','data' => ['class' => 'ml-4']]); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'ml-4']); ?>
                    <?php echo e(__('Register')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
        </form>
		</div>
		</div>

<?php /**PATH C:\laragon\www\PPRO605\resources\views/auth/register.blade.php ENDPATH**/ ?>