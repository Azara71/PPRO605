
<ul>

  <li class={{Request::is('main')? 'active' :''}}><a href="/main">Home</a></li>
  <li class={{Request::is('mes_conventions')? 'active' :''}}><a href="/mes_conventions">Conventions</a></li>
  <li class={{Request::is('info_perso')? 'active' :''}}><a href="/info_perso">Informations Personnelles</a></li>
  <li class={{Request::is('contact')? 'active' :''}}><a href="/contact">Contact</a></li>
  <li class=deconnexion><a href="accueil">Se deconnecter</a> </li>
</ul>