@extends('layouts.layout')

@section('title', 'Home')

@section('content')
	<header class="d-flex flex-column justify-content-around">
			<div class="container mx-auto row mt-5 pt-5">
				<div class="col-md-6">
					<div class="text-white">
						<div id="wlc" class="h3 bold mb-4">Bienvenue sur TendAxe</div>
						<div class="h5">
							TendAxe est votre profissionnel pour les appels d’offres et les consultation sur le marche publique et prive
						</div>
					</div>
				</div>
				<div class="col-md-6 text-center text-md-right">
					<a class="btn btn-primary btn-lg mt-4" href="{{ route('search') }}">Voir appels d'offres  <img class="pl-4" src="{{ asset('img/icons/arrow.png') }}"></a>
				</div>
			</div>
			<div class="container mx-auto text-white text-center">
				<h3 class="bold">Pourquoi TendAxe?</h3>
				<p class="hide-md">TendAxe caractérisé exceptionnellement par une stratégie tés fiable dans la collection des consultations afin d’avoire le plus grand nombre d'opportunités</p>
				<p>Avec l’abonnement a notre site internet, vous pouvez consulter tous les appels d’offres et les consultation dans votre domain d’activite et optenu tout les informations relatives ( resultats delais .... )</p>
			</div>
	</header>

		<section class="container my-5">
			<div class="row">
				<div class="col-md-4">
					<div class="d-flex">
						<img src="{{ asset('img/icons/doc2.png') }}" width="40px" height="40px">
						<small class="ml-3">
							Nous publions chaque jour, tous les appels d’offres et consultation disponibles sur le marché algérien. L’information est traitée et catégorisée
						</small>
					</div>
					<div class="d-flex mt-4">
						<img src="{{ asset('img/icons/search.png') }}" width="40px" height="33px">
						<small class="ml-3">
							Trouvez facilement les annonces qui vous conviennent à l’aide d’un moteur de recherche ergonomique et système de filtrage efficace (Mots clés, secteurs d’activités, Annonceurs, lieux…)
						</small>
					</div>
					<div class="d-flex mt-4">
						<img src="{{ asset('img/icons/copy.png') }}" width="40px" height="33px">
						<small class="ml-3">
							Consulter toutes les offres d'avantages proposées par tous les abonnés et Trouver des projet deuxième main en tant que sous-traitance depuis le moins disant
						</small>
					</div>
				</div>
				<div class="col-md-4 d-flex align-items-center justify-content-center my-2">
					<img class="img-fluid" src="{{ asset('img/figure1.png') }}">
				</div>
				<div class="col-md-4">
					<div class="d-flex">
						<img class="" src="{{ asset('img/icons/bell.png') }}" width="40px" height="40px">
						<small class="ml-3">
							Soyez informé des opportunités grâce à un système de notification avancé (synthèse quotidienne de ce que vous intéresse sera envoyé par un mail )
						</small>
					</div>
					<div class="d-flex mt-4">
						<img src="{{ asset('img/icons/7.png') }}" width="40px" height="20px">
						<small class="ml-3">
							TendAxe est partout avec vous : une accessibilité 24/24 ,7/7 sur ordinateur, tablette, mobile
						</small>
					</div>
					<div class="d-flex mt-4">
						<img src="{{ asset('img/icons/up.png') }}" width="40px" height="40px">
						<small class="ml-3">
							Publiez votre appel d’offres ou demande d’achat ou de sous-traitance en quelques clics et ciblez des fournisseurs qualifiés nationaux et internationaux.
						</small>
					</div>
				</div>
			</div>
		</section>

		<section id="howto" class="my-5">
			<h3 class="text-center bold">Comment s'inscrire</h3>
			<div class="container row mt-4 mx-auto">
				<div class="col-md-8">
					<div class="d-flex">
						<span class="bold mr-4 h4">1.</span>
						<p>
							Inscrivez gratuitement en tant que nouvel utilisateur et bénéficier de 5 jour d’essai gratuitement (nom de l'entreprise, numéro de téléphone et confirmation, e-mail, mot de passe et certains champs)
						</p>
					</div>
					<div class="d-flex">
						<span class="bold mr-4 h4">2.</span>
						<p>
							Connectez-vous avec votre e-mail et votre mot de passe
						</p>
					</div>
					<div class="h5 ml-5">
						Vous pouvez consulter gratuitement tous les appels d'offres pendant une durée de 5 jour
					</div>
				</div>
				<div class="col-md-4 text-center">
					<a href="{{ route('register') }}" class="btn btn-lg btn-primary">
						<b>Inscrivez-vous gratuitement</b>
						<br>
						avec 5 jours d’essai
					</a>
				</div>
			</div>
		</section>

		<section id="latest" class="container my-5">
			<h3 class="text-center mb-4 bold">Dernier appels</h3>
			@foreach (App\Models\Offre::latest()->take(4)->get() as $item)
			<div class="my-2">
				<div class="bg-white px-3 pt-3 border rounded">
					<div class="row mb-3">
						<div class="col-9 col-md-10 pr-0 bold">
							<div>
								{{ $item->titre }}
							</div>
						</div>
						<div class="col-3 col-md-2 pl-md-0 text-right">
							<img class="" src="{{ asset('img/icons/lock2.png') }}" width="64px">
						</div>
					</div>
						<div class="mb-2">
							<span class="bold">Annonceur: </span>
							<img src="{{ asset('img/icons/lock.png') }}">
							Réservé aux abonnés
						</div>
						<div class="mb-2">
							<span class="bold">Statut: </span>
							{{ $item->statut }}
						</div>
						<div class="mb-2">
							<span class="bold">Wilaya: </span>
							<img src="{{ asset('img/icons/lock.png') }}">
							Réservé aux abonnés
						</div>
						<div class="my-3 d-flex">
							<span class="mx-auto mt-2"> <img src="{{ asset('img/icons/play.png') }}"> {{ $item->date_pub }}</span>
							<span class="mx-auto mt-2"> <img src="{{ asset('img/icons/stop.png') }}"> {{ $item->date_limit }}</span>
							<a href="{{ route('detail', $item) }}" class="btn btn-sm btn-primary ml-auto">Detail</a>
						</div>
				</div>
			</div>
			@endforeach
			
			<div class="text-right">
				<a href="{{ route('search') }}" class="btn btn-primary">Tous les appels d’offre <img class="pl-4" src="{{ asset('img/icons/arrow.png') }}"></a>
			</div>
		</section>

		<section id="servies" class="container my-5">
			<div class="row">
				<div class="col-md-4 text-center px-4 my-2 ">
					<div class="bg-white p-3 border h-100">
						<img class="img-fluid mx-auto my-3" src="{{ asset('img/icons/doc.png') }}">
						<div class="h4 bold">+<span class="counter">1900</span></div>
						<small class="bold">Publications / Semaine</small>
					</div>
				</div>
				<div class="col-md-4 text-center px-4 my-2">
					<div class="bg-white p-3 border h-100">
						<img class="img-fluid mx-auto my-3" src="{{ asset('img/icons/building.png') }}">
						<div class="h4 bold">+<span class="counter">100000</span></div>
						<small class="bold">
							Entreprises sur l’annuaire
							(disponible bientôt)
						</small>
					</div>
				</div>
				<div class="col-md-4 text-center px-4 my-2 ">
					<div class="bg-white p-3 border h-100">
						<img class="img-fluid mx-auto my-3" src="{{ asset('img/icons/annouce.png') }}">
						<div class="h4 bold"><span class="counter">170</span></div>
						<small class="bold">sources d’annonces</small>
					</div>
				</div>
			</div>
		</section>

		<section id="offers" class="container my-5">
			<h3 class="bold text-center mb-3">Nos forfaits</h3>
			<ul>
				<li>
					Consulter tous les types d'annonces proposées (appels d'offres, consultations, annonces de subventions temporaires, annonces d'annulation, notifications, annonces de prolongation et de retard des délais, annonce d'offres ...)
				</li>
				<li>
					Alerter toutes les offres proposées dans votre secteur privé par e-mail pendant une semaine
				</li>
				<li>
					Ajoutez vos offres gratuitement pour une durée illimitée
				</li>
				<li>
					Consulter les offres les sous-traitences proposés par des entreprises ou les ordinairers.
				</li>
			</ul>
			<div class="row my-4">
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up">
					<div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-light-gray mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">Forfait gratuit à vie</div>
						<div class="h1 text-center text-green my-4">0.00 DZD</div>
						<div class="my-2">
							<ul class="">
								<li>Découvrez le site pendant une période illimitée sans passer en revue tous les détails</li>
								<li>Sélection illimitée de secteurs</li>
							</ul>
						</div>
						<div class="text-center mt-auto px-2">
							<button class="btn btn-primary bold w-100" data-toggle="modal" data-target="#exampleModal">Demander</button>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up" data-aos-duration="700">
					<div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-orange mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">Pack de bronze</div>
						<div class="h1 text-center text-green my-4">
							<span>11000</span> DZD/an
						</div>
						<div class="my-2">
							<ul class="">
								<li>Choisissez un secteur parmi les secteurs pour le package</li>
								<li>Toutes les options et fonctionnalités énumérées ci-dessus</li>
							</ul>
						</div>
						<div class="text-center mt-auto px-2">
							<button class="btn btn-primary bold w-100" data-toggle="modal" data-target="#exampleModal">Demander</button>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up" data-aos-duration="900">
					<div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-light-gray mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">pack Silver</div>
						<div class="h1 text-center text-green my-4">
							<span>19000</span> DZD/an
						</div>
						<div class="my-2">
							<ul class="">
								<li>Choisissez quatre secteurs parmi tous les secteurs</li>
								<li>Toutes les options et fonctionnalités énumérées ci-dessus</li>
							</ul>
						</div>
						<div class="text-center mt-auto px-2">
							<button class="btn btn-primary bold w-100" data-toggle="modal" data-target="#exampleModal">Demander</button>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up">
					<div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-yellow mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">Pack gold</div>
						<div class="h1 text-center text-green my-4">
							<span>26000</span> DZD/an
						</div>
						<div class="my-2">
							<ul class="">
								<li>Choisissez six secteurs parmi tous les secteurs</li>
								<li>Toutes les options et fonctionnalités énumérées ci-dessus</li>
							</ul>
						</div>
						<div class="text-center mt-auto px-2">
							<button class="btn btn-primary bold w-100" data-toggle="modal" data-target="#exampleModal">Demander</button>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up" data-aos-duration="700">
					<div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-red mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">pack platine</div>
						<div class="h1 text-center text-green my-4">
							<span>34000</span> DZD/an
						</div>
						<div class="my-2">
							<ul class="">
								<li>Sélection de tous les secteurs sans exception</li>
								<li>Toutes les options et fonctionnalités énumérées ci-dessus</li>
							</ul>
						</div>
						<div class="text-center mt-auto px-2">
							<button class="btn btn-primary bold w-100" data-toggle="modal" data-target="#exampleModal">Demander</button>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 p-2" data-aos="fade-up" data-aos-duration="900">
					<div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
						<div class="bg-blue mb-3 rounded-top" style="height: 6px"></div>
						<div class="text-center bold">Forfait pour enchères publiques</div>
						<div class="h1 text-center text-green my-4">
							<span>9000</span> DZD/an
						</div>
						<div class="my-2">
							<ul class="">
								<li>Voir toutes les annonces de ventes aux enchères dans tous les secteurs et tous les états pour un an 9000.00 AD</li>
							</ul>
						</div>
						<div class="text-center mt-auto px-2">
							<button class="btn btn-primary bold w-100" data-toggle="modal" data-target="#exampleModal">Demander</button>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		       	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		       	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		       	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		       	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		       	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		       	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>

		<script type="text/javascript">
    		// navbar
			$(".navbar").removeClass("bg-light");
			$(".navbar").removeClass("navbar-light");
			$(".navbar").addClass("navbar-dark");
			$("#logo").addClass("text-white");
			
    		$(window).scroll(function (event) {
    			var height = $(window).scrollTop();

    			    if(height <= 0) {
    			        $(".navbar").removeClass("bg-light shadow navbar-light");
    			        $(".navbar").addClass("navbar-dark");

    			        $("#logo").addClass("text-white");
    			    }else{
    			    	$(".navbar").addClass("bg-light shadow navbar-light");
    			    	$(".navbar").removeClass("navbar-dark");

    			        $("#logo").removeClass("text-white");
    			    }

    		});

    		$( document ).ready(function () {
    			$('.counter').counterUp({
    			   delay: 10,
    			   time: 1000,
    			 });
    			// init animate on scroll
    			AOS.init();
    		});

    	</script>
@endsection