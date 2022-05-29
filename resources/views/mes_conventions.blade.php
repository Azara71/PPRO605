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
    @include('layout.logo')
    <div class=container_convention>
         
    
      

        @foreach($conventions as $convention)
             <div class=convention>
            <div class=titre>
                  {{$convention->procedure->procedure_modele->nom_procedure}}
            </div>
            <div class=content>
                <div class=description>
                   <p>{{$convention->description}}</p>
                </div>
                <div class=info_complémentaire>
                                
                            <div class=tuteur>
                            {{$convention->tuteur->nom}}
                            </div>
                               <div class=tuteur>
                            Date de création :  {{$convention->date_creation}}
                            </div>
                             <div class=tuteur>
                            Modifiée le : {{$convention->date_derniere_modification}}
                            </div>
                            <div class=tuteur>
                            @if($convention->procedure->num_etape <= $convention->procedure->nombre_etapes_max)
                            Etapes : {{$convention->procedure->num_etape}} / {{$convention->procedure->nombre_etapes_max}} 
                           <div class=tuteur>
                            Etat : En Cours
                            </div>
                            @else
                            Etapes : Fini
                            
                            @endif
                            </div>
                         
                           <div class=buttons-list>
                                @if($convention->procedure->num_etape<=$convention->procedure->nombre_etapes_max)
                               <div class=voir onclick="location.href='mes_conventions/edit_convention/{{$convention->id}}'">
                                   @include('svg.stylo')
                                </div>
                                @else 
                                 <div class=ajout_avenant onclick="location.href='mes_conventions/voir_avenants/{{$convention->id}}'">
                                 Voir les avenants
                                   @include('svg.add_etudiant')
                                </div>
                                



                                @endif
                               <div class=voir onclick="location.href='mes_conventions/dl/{{$convention->id}}'">
	                                @include('svg.dl')
                               </div>
                             </div>
                </div>
          </div>
        </div>
                  

        @endforeach
            

          @if(Auth::user()->statut=='Etudiant')
        <div class=convention_plus onclick="location.href='mes_conventions/create';">
           <div class=plus >
              @include('svg.plus')
          </div>
        </div>
        @endif
      
        @include ('layout.footer')
</body>