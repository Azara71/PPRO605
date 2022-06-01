
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo asset('css/info_perso.css')?>" type="text/css">

    
	</head>
	<body>
        	 @foreach ($errors->all() as $error)
               					 <li>{{ $error }}</li>
          					  @endforeach
    @include('layout.navbar')
              <div class=etapes>
                    @foreach ($avenant->procedure->etapes as $etape)
                    @if($loop->iteration==$avenant->procedure->num_etape)
                    <div class=circleended>
                        {{$loop->iteration}} 
                        
                    </div>
                    @elseif($loop->iteration>$avenant->procedure->num_etape)
                    <div class=circletodo>
                        {{$loop->iteration}} 
                    </div>
                    @else 
                    <div class=circledone>
                          {{$loop->iteration}} 
                    </div>
                    @endif
                    <div class=explication_etape>
                        {{$etape->description}}
                    </div>
                    @endforeach
                </div>
    
     <form method="POST" action="{{route('maj_avenant',[$avenant->id])}}" enctype="multipart/form-data">
			@csrf
			<div class=container>
               
				<div class=info>
					<div class=titre>
						Modifier ma convention.
					</div>
                    <div class=content>
                              <div class=champs>
								     <div class=texte-champs >
									    Date de création :
								     </div>
								        {{$avenant->created_at}} 
						    </div>
                             <div class=champs>
								     <div class=texte-champs >
									    Date de dernière modification :
								     </div>
								        {{$avenant->updated_at}} 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									      Date de début :
								     </div>
								        {{$avenant->date_debut}} 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									     Date de fin :
								     </div>
								        {{$avenant->date_fin}} 
						     </div>
                        
                        @if(Auth::user()->acces->id==$avenant->procedure->etapes[$avenant->procedure->num_etape-1]->etape_modele->acces->id)
                          <div class=champs>
                                        <div class=texte-champs>
                                        Mettre à jour l'avenant
                                        </div>
                                  	<input type="file" id="avenant" name="avenant" accept="pdf" required>
                          </div>
                          <div class=texte-champs>
					         <button class=sub type=submit">	
					         <div class=button>
                             Passer à l'étape suivante :
						     </div>
						  </div>
                        @else 
                        Ce n'est pas encore à vous de faire avancer la procédure...
                        @endif

                    </div>
                </div>
            </div>
     </form>
    </body>
</html>
