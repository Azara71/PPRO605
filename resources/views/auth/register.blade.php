<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo asset('css/register.css')?>" type="text/css">
<script type="text/javascript">
        $(document).ready(function () {
            $('#university_selection').on('change', function () {
                var universityId = this.value;
                $('#fac').html('');
                $.ajax({
                    url: '{{ route('getFacs') }}?univ_id='+universityId,
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
                    url: '{{ route('getFacs') }}?univ_id='+universityId,
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
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST"  action="{{ route('register') }}">
            @csrf
			<h1 style="color:white; text-align:center;"> Formulaire d'inscription </h1>
            <!-- Name -->
            <div>
                <x-label for="prénom" :value="__('Prénom')" style="color:white" />

                <x-input id="prénom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus />
            </div>

			<div>
                <x-label for="nom" :value="__('Nom')" />

                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus />
            </div>


            <!-- Email Address -->
            <div class="mt-4">
				
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
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
					@foreach($univs as $univ)
						<option value="{{$univ->id}}">{{$univ->nom_université}}</option>
					@endforeach
					
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
						<option value="fac1">L1</option>
						<option value="fac2">L2</option>
						<option value="fac3">L3</option>
					</select>
				</div>
				<div class=entry>Numéro d'étudiant:</div>
					<input type="text" placeholder="Rentrer votre numéro d'étudiant" id="numero_etudiant" name="numero_etudiant" >
				</div>





			<!--Saisie visible que si entreprise-->
			<div id="saisie_entreprise" style="display:none;">
				<div class=entry id="name">Entreprise :</div>
				
				<div class="custom-select">
				<select id="entreprise_selection" name="entreprise" >
					<option value="" class=opt>Choisissez une entreprise...</option>
					@foreach($entreprise as $entreprise)
						<option value="{{$entreprise->id}}">{{$entreprise->nom_entreprise}} - {{$entreprise->num_siret}}</option>
					@endforeach
				</select>
				</div>
				<div class=entry>
						Fonction occupée :
					</div>
					<input type="text" placeholder="Rentrer votre fonction" id="fonction" name="fonction" >
			</div>
				
				<!--Saisie visible que si université-->
				<div id="saisie_université" style="display:none;">
				<div class=entry id="name">Université :</div>
				
				<div class="custom-select">
				<select  id="university_two_selection" name="universite_univ" >
					<option value="">Choisissez une université...</option>
					@foreach($univs as $univ)
						<option value="{{$univ->id}}">{{$univ->nom_université}}</option>
					@endforeach
					
				</select>
				</div>
				<div class=entry >Faculté :</div>

<div class="custom-select">
<select id="fac_two" name="faculte_univ" >
	<option value="" class=opt>Choisissez un UFR...</option>

</select>
</div>
				<div class=entry>
					Fonction occupée :
				</div>
				<input type="text" placeholder="Rentrer la fonction occupée au sein de l'entreprise." id="fonction_université" name="fonction_univ" >
				</div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
		</div>
		</div>

