<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo asset('css/register.css')?>" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
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
				<form>
					<h1 style="color:white; text-align:center;"> Formulaire d'inscription </h1>
					<div class=entry>
						Prénom :
					</div>
					<input type="text" placeholder="Entrer le prénom" name="firstname" required>
					<div class=entry>
						Nom :
					</div>
					<input type="text" placeholder="Entrer le nom " name="name" required>
					<div class=entry>
						Nom d'utilisateur :
					</div>
					<input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
					<div class=entry>
						Mot de passe :
					</div>
					<input type="text" placeholder="Entrer le mail" name="mail" required>
					<div class=entry>
						Mail :
					</div>
					<input type="text" placeholder="Entrer le mot de passe" name="password" required>
					<div class=entry>
						Adresse:
					</div>
					<input type="text" placeholder="Entrer votre adresse" name="adresse" required>
					<div class=entry>
						Statut:
					</div>
					<!-- Choix du type d'utilisateur -->
			
			<div class=containerofradio>
				<label for="etudiant" style="color:white">Etudiant</label>
				<input type="radio" id="etudiant" name="statut" value="Etudiant" checked onclick="ShowHideDiv('etudiant')"/>
				<label for="entreprise" style="color:white">Entreprise</label><input type="radio" id="entreprise" name="statut" value="Entreprise" onclick="ShowHideDiv('entreprise')"/>
				<label for="université" style="color:white">Université</label><input type="radio" id="université" name="statut" value="Université" onclick="ShowHideDiv('université')"/>
			</div>
			<!--Saisie visible que si étudiant-->
			<div id="saisie_etudiant">
				<div class=entry id="name">Université :</div>
				
				<div class="custom-select">
				<select  id="university_selection" required>
					<option value="">Choisissez une université...</option>
					@foreach($univs as $univ)
						<option value="{{$univ->id}}">{{$univ->nom_université}}</option>
					@endforeach
					
				</select>
				</div>

				<div class=entry id="name">Faculté :</div>

				<div class="custom-select">
				<select id="fac" required>
					<option value="" class=opt>Choisissez un UFR...</option>
				
				</select>
				</div>
				<div class=entry id="name">Année :</div>
				<div class="custom-select">
					<select id="annee_selection" required>
						<option value="" class=opt>Choisissez une année ...</option>
						<option value="fac1">L1</option>
						<option value="fac2">L2</option>
						<option value="fac3">L3</option>
					</select>
				</div>
				<div class=entry>Numéro d'étudiant:</div>
					<input type="text" placeholder="Rentrer votre numéro d'étudiant" id="numero_etudiant" >
				</div>





			<!--Saisie visible que si entreprise-->
			<div id="saisie_entreprise" style="display:none;">
				<div class=entry id="name">Entreprise :</div>
				
				<div class="custom-select">
				<select id="entreprise_selection" required>
					<option value="" class=opt>Choisissez une entreprise...</option>
					<option value="fac1">ent1</option>
					<option value="fac2">ent2</option>
					<option value="fac3">ent3</option>
					<option value="fac4">ent4</option>
					<option value="fac5">ent5</option>
				</select>
				</div>
				<div class=entry>
						Fonction occupée :
					</div>
				<input type="text" placeholder="Rentrer la fonction occupée" id="fonction_entreprise" required >
		</div>
				
				<!--Saisie visible que si université-->
				<div id="saisie_université" style="display:none;">
				<div class=entry id="name">Université :</div>
				
				<div class="custom-select">
				<select  id="university_two_selection" required>
					<option value="">Choisissez une université...</option>
					@foreach($univs as $univ)
						<option value="{{$univ->id}}">{{$univ->nom_université}}</option>
					@endforeach
					
				</select>
				</div>
				<div class=entry id="name">Faculté :</div>

<div class="custom-select">
<select id="fac_two" required>
	<option value="" class=opt>Choisissez un UFR...</option>

</select>
</div>
				<div class=entry>
					Fonction occupée :
				</div>
				<input type="text" placeholder="Rentrer la fonction occupée au sein de l'entreprise." id="fonction_université" required>
				</div>

				<input type="button" class="button" value="Je souhaite m'inscrire.">



			</div>
			<!-- LOGO -->
			<div class=container_right>
				<div class=logo>
					<img src="/icone/logo_bleu.png" alt "logo" class="image_logo">
				</div>
			</div>
		</div>
	</body>
	<!-- FOOTER-->
