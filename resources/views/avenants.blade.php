<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo asset('css/convention.css')?>" type="text/css">

    
	</head>

    <body>
    @include('layout.navbar')

     <div class=container_convention>
         
        @foreach ($avenants as $avenant)
          <div class=convention>
            <div class=titre>
            AVENANT
            </div>
          

            <div class=content>
                <div class=description>
                   <p>{{$convention->description}}</p>
                </div>
                <div class=info_complémentaire>

                 <div class=tuteur>
                     Date de début: {{$avenant->date_debut}}
                 </div>
                 <div class=tuteur>
                     Date de fin: {{$avenant->date_fin}}
                 </div>
                    
                    @if($avenant->procedure->num_etape<=$avenant->procedure->nombre_etapes_max)
                    <div class=tuteur>

                    Etat de la procédure : En cours... 
                     </div>
                    {{$avenant->procedure->num_etape }} / {{ $avenant->procedure->nombre_etapes_max}}
                    @else
                    <div class=tuteur>
                     Etat de la procédure: Fini... 
                     </div>
                
                 
                 @endif

                 
                <div class=buttons-list>
                      <div class=ajout_avenant onclick="location.href='/mes_conventions/avenant/{{$avenant->id}}'">
                                 Voir la procédure de l'avenant
                      </div>
                       <div class=voir onclick="location.href='/mes_conventions/dl_avenant/{{$avenant->id}}'">
	                                @include('svg.dl')
                        </div>
                </div>
                


                 </div>



            </div>
           

            </div>

        @endforeach
   @if(Auth::user()->statut=='Etudiant')
        <div class=convention_plus onclick="location.href='/mes_conventions/{{$convention->id}}/avenant/create';">
           <div class=plus >
              @include('svg.plus')
          </div>
        </div>
        @endif
    </div>


    </body>
</html>