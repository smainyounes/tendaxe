@extends('layouts.layout')

@section('title', 'profile')
    
@section('content')
    <div class="container main">
        <x-alert />
        <h1 class="bold text-center">Profile</h1>
        <div class="text-right">
            <a href="{{ route('offre.add') }}" class="btn btn-primary">Ajouter Offre</a>
        </div>

        @if(count($errors)>0)
            @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="row mt-3 mb-5">
            <div class="col-md-3">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Liste Offres</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Parametres</a>
              </div>
            </div>
            <div class="col-md-9">
              <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                    @if ($offres)
                        @foreach ($offres as $offre)
                            <div class="my-2">
                                <div class="bg-white px-3 pt-3 border rounded">
                                    <div class="row">
                                        <div class="col-9 col-md-10 bold">
                                            {{ $offre->titre }}
                                        </div>
                                        <div class="col-3 col-md-2 text-right">
                                            @if ($logo)
                                                <img class="rounded-circle" src="{{ asset('storage/logo/' . $logo ) }}" width="64px">
                                            @else
                                                <img class="" src="{{ asset('img/1.png') }}" width="64px">
                                            @endif
                                        </div>
                                    </div>
                                        <div class="mb-2">
                                            <span class="bold">Statut: </span>
                                            {{ $offre->statut }}
                                        </div>
                                        <div class="mb-2">
                                            <span class="bold">Wilaya: </span>
                                            
                                            {{ $offre->wilaya }}
                                        </div>
                                        <div class="my-3 d-flex">
                                            <span class="mx-auto mt-2"> <img src="img/icons/play.png"> {{ $offre->date_pub }}</span>
                                            <span class="mx-auto mt-2"> <img src="img/icons/stop.png"> {{ $offre->date_limit }}</span>
                                            <div class="ml-auto">
                                                <a href="{{ route('detail', $offre) }}" class="btn btn-sm btn-primary ">Detail</a>
                                                {{-- <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $offre->id }}" >Supprimer</button> --}}
                                            </div>
                                            
                                        </div>
                                    
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-center">Aucun offre</h3>
                    @endif
                    
                    {{ $offres->links() }}
                    
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="bg-white p-3">
                        <h3 class="text-center">Changer mot de passe</h3>
                        <form action="{{ route('user.password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Ancient mot de passe</label>
                                <input class="bg-light form-control" type="password" name="old_password">
                            </div>
                            <div class="form-group">
                                <label for="">Nouveau mot de passe</label>
                                <input class="bg-light form-control" type="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="">repetez nouveau mot de passe</label>
                                <input class="bg-light form-control" type="password" name="password_confirmation">
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary px-4">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    {{-- <!-- delete modal -->
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
	        <form method="POST" action="{{ route('offre.destroy') }}">
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
    </script> --}}
@endsection