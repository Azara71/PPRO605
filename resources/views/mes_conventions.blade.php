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
        <div class=convention>
            <div class=titre>
                  Le titre de ma convention
            </div>
            <div class=content>
                <div class=description>
                      <p>n thesages, and more recently with desktop publishing software like Aldus PageMaker including versions of L, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.n the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.n the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.     </p>
                </div>
                <div class=info_complémentaire>
                        <div class=tuteur>
                            Nom tuteur
                        </div>
                        <div class=eleve>
                            Nom élève
                        </div>
                </div>
          </div>
           <div class=buttons-list>
             <div class=voir>
                 @include('svg.stylo')
            </div>
            <div class=voir>
                @include('svg.dl')
            </div>
          </div>
        </div>

        <div class=convention>
            <div class=titre>
                  Le titre de ma convention
            </div>
            <div class=content>
                <div class=description>
                      <p>n thesages, and more recently with desktop publishing software like Aldus PageMaker including versions of L, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.n the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.n the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.     </p>
                </div>
                <div class=info_complémentaire>
                        <div class=tuteur>
                            Nom tuteur
                        </div>
                        <div class=eleve>
                            Nom élève
                        </div>
                </div>
          </div>
           <div class=buttons-list>
             <div class=voir>
                  @include('svg.stylo')
            </div>
            <div class=voir>
	            @include('svg.dl')
            </div>
          </div>
        </div>
        @if(Auth::user()->statut=='Etudiant')
        <div class=convention_plus onclick="location.href='mes_conventions/create';">
           <div class=plus >
              @include('svg.plus')
          </div>
        </div>
        @endif
    

       
        @include ('layout.footer')
</body>