
<ul>

  <li style={{Request::is('main')? 'background-color:rgb(64,154,182);' :''}}><a href="main">Home</a></li>
  <li style={{Request::is('mes_conventions')? 'background-color:rgb(64,154,182);' :''}}><a href="mes_conventions">Conventions</a></li>
  <li style={{Request::is('info_perso')? 'background-color:rgb(64,154,182);' :''}}><a href="info_perso">Informations Personnelles</a></li>
  <li style={{Request::is('contact')? 'background-color:rgb(64,154,182);' :''}}><a href="contact">Contact</a></li>
  @if(Auth::user()->travailleur !=NULL)
    @if(Auth::user()->travailleur->job_id==8)
    <li style={{Request::is('liste_etudiant')? 'background-color:rgb(64,154,182);' :''}}><a href="liste_etudiant">Liste d'étudiant</a></li>
    <li style={{Request::is('procedures') || Request::is('creer_procedure')? 'background-color:rgb(64,154,182);' :''}}><a href="procedures">Procedures de ma faculté</a></li>
    @endif
  @endif
  

  <li class=deconnexion> <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Se deconnecter') }}
                    </x-responsive-nav-link>
                </form></li>
 
</ul>