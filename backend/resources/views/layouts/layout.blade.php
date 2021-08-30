<!doctype html>
<html lang="fr">
  	<head>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

		<!-- selectpicker bootstrap CSS -->
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
		
	    <!-- animate on scroll css-->
	    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

	    <!-- custom css -->
	    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
	    

	    <!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

	    <!-- counting animation -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script>
	    <script src="{{ asset('vendor/counterup/jquery.counterup.min.js') }}"></script>


	    <!-- animate on scroll js -->
	    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

		{{-- dzayer js --}}
		<script src="{{ asset('vendor/dzayer/dzayer.js') }}"></script>

		<!-- selectpicker bootstrap js -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
		
		{{-- datepicker --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
		<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

	    <title>TendAxe | @yield('title')</title>
  	</head>
  	<body class="bg-light">	  	
		<nav class="navbar navbar-expand-md navbar-light bg-light px-4 py-md-0 shadow fixed-top">
		  <a class="navbar-brand" href="/">
		  	<div class="h1 my-1">
		  		<b><span id="logo" class="">Tend</span><span class="text-primary">Axe</span></b>
		  	</div>
		  </a>
		  <button class="navbar-toggler" type="button" data-toggle="slide-collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav ml-auto align-items-center">
				<li class="nav-item px-2">
				  <a class="nav-link" href="/">Acceuil</a>
				</li>
				<li class="nav-item px-2">
				  <a class="nav-link" href="{{ route('help') }}">Aide</a>
				</li>
				<li class="nav-item px-2">
				  <a class="nav-link" href="{{ route('search') }}">Appels d'offre</a>
				</li>
				@auth
					@if (Auth::user()->type_user === 'abonné')
					<li class="nav-item px-2">
						<a class="nav-link" href="{{ route('offre.favorit') }}">favoris</a>
					</li>
					@endif					
					<li class="nav-item px-2 dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="mr-2">{{ Auth::user()->nom ." ". Auth::user()->prenom  }}</span>
							<img src="{{ asset('img/icons/user.png') }}" class="img-fluid">
						</a>
						<form method="POST" action="{{ route('logout') }}" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
							@csrf
							<a class="dropdown-item" href="{{ route('profile') }}">Parametres</a>
							<a class="dropdown-item" href="{{ route('abonnement') }}">Abonnement</a>
							<a class="dropdown-item" href="{{ route('notification') }}">Notification</a>
							<a class="dropdown-item" href="{{ route('user.offers') }}">Mes Offres</a>
							<div class="dropdown-divider"></div>
							<button type="submit" class="dropdown-item">se deconnecter</button>
						</form>

					</li>
				@endauth

				@guest
					<li class="nav-item px-2">
						<a class="nav-link" href="{{ route('login') }}">Connexion</a>
					</li>
					<li class="nav-item px-2">
						<a class="btn btn-primary" href="{{ route('register') }}">Inscription</a>
					</li>
				@endguest
				
		    </ul>
		  </div>
		</nav>

        @yield('content')

        <footer class="footer bg-dark px-5 pt-5 pb-2">
			<div class="row">
				<div class="col-md-2">
					<div class="h2 text-md-left text-center">
						<b><span class="text-white">Tend</span><span class="text-primary">Axe</span></b>
					</div>
				</div>
				<div class="col-md-4 tendaxe mt-md-3 mb-2">
					<p class="text-white">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lobortis in nibh massa eget. Lorem velit, commodo vitae nulla sed volutpat rhoncus sed.
					</p>
					<div class="text-md-left text-center">
						<a href="{{ route('help') }}" class="text-primary">Aide | Documents utiles | CGU</a>
					</div>
				</div>
				<div class="offset-md-3 col-md-3 text-md-left text-center">
					<h3 class="text-white">Contact</h3>
					<div class="my-3">
						<img src="{{ asset('img/icons/phone.png') }}"> <span class="ml-3 text-white"> 02 67 43 56 65 </span>
					</div>
					<div class="my-3">
						<img src="{{ asset('img/icons/msg.png') }}" width="22px" height="17px"> <span class="ml-3 text-white"> tendaxe@gmail.com </span>
					</div>
					<div class="my-3">
						<img src="{{ asset('img/icons/fb.png') }}"> <span class="ml-3 text-white"> tendaxe </span>
					</div>
				</div>
			</div>
		</footer>

        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

		@if (Auth::check() && (Auth::user()->type_user === 'admin' || Auth::user()->type_user === 'publisher'))
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<div class="modal-body">
					Voulez vous supprimer cet offre?
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">non</button>
					<form method="POST" action="{{ (Auth::user()->type_user !== 'content') ? route('admin.offre.destroy') : route('rep.offre.destroy') }}">
						@csrf
						@method('DELETE')
						<input type="number" name="offre" id="offre_id" hidden>
						<button class="btn btn-primary">Oui</button>
					</form>
					</div>
				</div>
				</div>
		  	</div>
	  
		  <script type="text/javascript">
	  
			  $('#exampleModalCenter').on('show.bs.modal', function (event) {
				  var button = $(event.relatedTarget) // Button that triggered the modal
				  var id = button.data('id') 
				  
				  $('#offre_id').val(id);
			  });
		  </script>
		@endif

    </body>