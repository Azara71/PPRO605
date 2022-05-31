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
    @include('layout.navbar')
             <div class=etapes>
                    @foreach ($etapes as $etape)
                    @if($loop->iteration==$procedure->num_etape)
                    <div class=circleended>
                        {{$loop->iteration}} 
                        
                    </div>
                    @elseif($loop->iteration>$procedure->num_etape)
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
       <form method="POST" action="/public/maj_convention/{{$convention[0]->id}}" enctype="multipart/form-data">
			@csrf
			<div class=container>
               
				<div class=info>
					<div class=titre>
						Modifier ma convention.
					</div>
            
					<div class=content>
                        @if($procedure->num_etape<=1 )
                            @if(Auth::user()->acces->Description=='Etudiant')
                                  Vous pouvez modifier cette convention jusqu'à ce que la première étape soit terminée.
                                
                                  
                                  <div class=champs>
								     <div class=texte-champs >
									    Description de la convention
								     </div>
								    <input type="text" id="description" name="description" placeholder="{{$convention[0]->description}}" required>
						          </div>
                                  <div class=champs>
                                        <div class=texte-champs>
                                          Mettre à jour sa convention :
                                        </div>
                                  	<input type="file" id="convention" name="convention" accept="pdf" required>
                                  </div>
                                
                            @else    <!-- SI NON ETUDIANT -->
                            <div class=champs>
								     <div class=texte-champs >
									    Description de la convention :
								     </div>
								     {{$convention[0]->description}}     
						    </div>
                            <div class=champs>
								     <div class=texte-champs >
									    Date de création :
								     </div>
								        {{$convention[0]->date_creation}} 
						    </div>
                             <div class=champs>
								     <div class=texte-champs >
									    Date de dernière modification :
								     </div>
								        {{$convention[0]->date_derniere_modification}} 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									      Date de début :
								     </div>
								        {{$convention[0]->date_debut}} 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									     Date de fin :
								     </div>
								        {{$convention[0]->date_fin}} 
						     </div>
                             @endif 

                        @else <!--SI ON EST PAS A L'ETAPE 1-->
                           <div class=champs>
								     <div class=texte-champs >
									    Description de la convention :
								     </div>
								     {{$convention[0]->description}}     
						    </div>
                            <div class=champs>
								     <div class=texte-champs >
									    Date de création :
								     </div>
								        {{$convention[0]->date_creation}} 
						    </div>
                             <div class=champs>
								     <div class=texte-champs >
									    Date de dernière modification :
								     </div>
								        {{$convention[0]->date_derniere_modification}} 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									      Date de début :
								     </div>
								        {{$convention[0]->date_debut}} 
						     </div>
                              <div class=champs>
								     <div class=texte-champs >
									     Date de fin :
								     </div>
								        {{$convention[0]->date_fin}} 
						     </div>
                            @endif




                            
                   
                        @if(Auth::user()->acces==$etape_acces)
                             
                                  <div class=champs>
                                        <div class=texte-champs>
                                        Mettre à jour la convention
                                        </div>
                                  	<input type="file" id="convention" name="convention" accept="pdf" required>
                                  </div>
                                  	<div class=texte-champs>
					   <button class=sub type=submit">	
					   <div class=button>
                                          Passer à l'étape suivante :
						</div>
						</div>
            			</button>

                           
                        @else
                        <div class="">Etape en attente de validation.</div>           
                        @endif
                    </div>
                </div>
             
            </div>
        </form>
       
    



   @include ('layout.footer')
    </body>
</html>