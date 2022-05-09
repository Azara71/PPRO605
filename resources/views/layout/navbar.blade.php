
<ul>

  <li class={{Request::is('main')? 'active' :''}}><a href="/main">Home</a></li>
  <li class={{Request::is('mes_conventions')? 'active' :''}}><a href="/mes_conventions">Conventions</a></li>
  <li class={{Request::is('info_perso')? 'active' :''}}><a href="/info_perso">Informations Personnelles</a></li>
  <li class={{Request::is('contact')? 'active' :''}}><a href="/contact">Contact</a></li>
  <li class=deconnexion> <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Se deconnecter') }}
                    </x-responsive-nav-link>
                </form></li>
 
</ul>