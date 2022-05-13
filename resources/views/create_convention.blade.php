<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
		<link rel="stylesheet" href="<?php echo asset('css/info_perso.css')?>" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<script type="text/javascript">
        $(document).ready(function () {
			$('#l_etape').hide();

            $('#procedure').on('change', function () {
				var compteur=1;
                var procedureId = this.value;
				$('.liste_etape').empty();			

				if(this.value==""){
					$('#l_etape').hide();
				}
				else{
					$('#l_etape').show();
				}

                $.ajax({
                    url: '{{ route('getEtapes') }}?procedure_id='+procedureId,
                    type: 'get',
                    success: function (res) {
                        $.each(res, function (key, value) {
							$(".liste_etape").append("<div class=etapes>"+compteur+")"+value.description+" </div>");
							compteur+=1;
                        });
                    }
                });
            });
		});

		 	$(document).ready(function () {
            $('#entreprise_selection').on('change', function () {
                var entrepriseId = this.value;
                $('#tuteur_selection').html('');
                $.ajax({
                    url: '{{ route('getTuteurs') }}?ent_id='+entrepriseId,
                    type: 'get',
                    success: function (res) {
                        $('#tuteur_selection').html('<option value="">Choisir un tuteur</option>');
                        $.each(res, function (key, value) {
                            $('#tuteur_selection').append('<option value="' + value
                                .id + '">' + value.nom  + '</option>');
                        });
                    }
                });
            });
		});
		</script>
		@include('layout.navbar')
		<form method="POST" action="{{route('upload_convention')}} " enctype="multipart/form-data">
			@csrf
			<div class=container>
				<div class=info>
					<div class=titre>
						Ma nouvelle convention
					</div>
					<div class=content>
						 @foreach ($errors->all() as $error)
               					 <li>{{ $error }}</li>
          					  @endforeach
						<div class=champs>
								<div class=texte-champs>
									Description de la convention
								</div>
								<input type="text" id="description" name="description" required>
						</div>
						<div class=champs>
						<div class=texte-champs>
							Entreprise dans laquelle le stage sera fait : 
						</div>
				
				<select id="entreprise_selection" name="entreprise_selection" >
					<option value="" class=opt>Choisissez une entreprise...</option>
					@foreach($entreprise as $entreprise)
						<option value="{{$entreprise->id}}">{{$entreprise->nom_entreprise}} - {{$entreprise->num_siret}}</option>
					@endforeach
				</select>
				</div>		
				<div class=champs>
					<div class=texte-champs>
						Tuteur de stage :
					</div>
				<select name="tuteur_selection" id="tuteur_selection"required>
					<option value="" class=opt>Choisir un tuteur </option>
				</select>
				</div>							
						<div class=champs>
							<div class=texte-champs>
								Choisissez une procédure
							</div>
							<select id="procedure" name="procedure" "><option value=""> Choisissez une procédure </option>
							@foreach ($proc as $pro)
							<option value="{{$pro->id}}">
								{{$pro->nom_procedure}}
							</option>
							@endforeach
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
						<div id="l_etape" >
						<div class=texte-champs>
							Liste d'étape durant la procédure:
						</div>
					<div class=liste_etape>
						
					</div>
					</div>
					<div class=champs>
						<div class=texte-champs>
							Convention
						</div>

					<input type="file" id="convention" name="convention" accept="pdf" required>
					</div>
						<div class=texte-champs>
					   <button class=sub type=submit">	
					   <div class=button>
							Enregistrer
						</div>
						</div>
            			</button>

					</form>
