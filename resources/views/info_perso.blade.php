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
	<script type="text/javascript">

			$(document).ready(function () {
            $('#entreprise_selection').on('change', function () {
                var entrepriseId = this.value;
                $('#job').html('');
                $.ajax({
                    url: '{{ route('getJobs') }}?ent_id='+entrepriseId,
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

    @include('layout.navbar')
	<form method="post" action="{{route('modify',Auth::user()->id)}}">
	@csrf
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
						<input type="text" placeholder="{{Auth::user()->prenom}}" name="prenom" >
					</div>
			</div>
				<div class=champs>
					<div class=texte-champs>
						Nom :
					</div>
					<div class=saisie-champs>
					<input type="text" placeholder="{{Auth::user()->nom}}" name="nom" >
					</div>
				</div>

				
				<div class=champs>
				<div class=texte-champs>
						Mail:
				</div>	
				<div class=saisie-champs>
					{{Auth::user()->email}}
				</div>		
				</div>
		
				
				<div class=champs>
					<div class=texte-champs>
						Statut :
					</div>	
					<div class=saisie-champs>
					{{Auth::user()->statut}}

				</div>	
				</div>

				@if(Auth::user()->statut=='Etudiant')
				<div class=champs>
					<div class=texte-champs>
					Faculté : 
					</div>
					<div class=saisie-champs>
					{{Auth::user()->etudiant->facultes[0]->nom_faculte}}	
					</div>
				</div>
				<div class=champs>
					<div class=texte-champs>
					Université : 
					</div>
					<div class=saisie-champs>
					{{Auth::user()->etudiant->facultes[0]->universite->nom_université}}	
					</div>
				</div>

				@endif

				@if(Auth::user()->statut=='Entreprise')
				@if(Auth::user()->travailleur->job_id!=NULL) 
				<div class=champs>
					<div class=texte-champs>
						Entreprise :
					</div>	
					<div class=saisie-champs>
						{{Auth::user()->travailleur->entreprises[0]->nom_entreprise}}
					</div>
				</div>	
				<div class=champs>
					<div class=texte-champs>
						Emploi dans l'entreprise : 
					</div>	
					<div class=saisie-champs>
						{{Auth::user()->travailleur->job->nom_job}}
					</div>
				</div>	
				@endif
				
				@if(Auth::user()->travailleur->job==NULL)
				<div class=champs>
					<div class=texte-champs>
						Choisissez une entreprise :
					</div>	
					<div class=saisie-champs>
						
					<select id="entreprise_selection" name="entreprise" ">
					@foreach($entreprise as $entreprise)
						<option value="{{$entreprise->id}}">{{$entreprise->nom_entreprise}} - {{$entreprise->num_siret}}</option>
					@endforeach
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
				@endif
			@endif


				@if(Auth::user()->statut=='Université')
				<div class=champs>
					<div class=texte-champs>
						Statut à l'université :
					</div>	
					<div class=saisie-champs>
					{{Auth::user()->travailleur->job->nom_job}} 
					</div>
				</div>	
				<div class=champs>
					<div class=texte-champs>
					Université : 
					</div>
					<div class=saisie-champs>
					{{Auth::user()->travailleur->facultes[0]->universite->nom_université}}	
					</div>
				</div>
				<div class=champs>
					<div class=texte-champs>
					Faculté : 
					</div>
					<div class=saisie-champs>
					{{Auth::user()->travailleur->facultes[0]->nom_faculte}}	
					</div>
				</div>

				@endif
				<button class=sub type=submit">	<div class=button>
						Enregistrer
						@include('svg.stylo')
				</div>
</button>
				
				</div>		
			

			</div>

		</div>
	</div>
</form>
	@include('layout.logo')





	@include ('layout.footer')



</body>