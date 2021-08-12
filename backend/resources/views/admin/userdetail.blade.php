@extends('layouts.panel')

@section('title', 'user detail')

@section('content')

    @if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

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

    <div class="bg-white p-3">
        {{-- etab infos --}}
        @if ($etab)
            <h4>Etablissement</h4>
            @if ($etab->logo)
                <img class="rounded-circle" width="120px" src="{{ asset('storage/logo/'.$etab->logo) }}" alt="">
            @endif
            <ul>
                <li>nom etablissement : {{ "$etab->nom_etablissement" }}</li>
                <li>category : {{ "$etab->category" }}</li>
                <li>emplacement : {{ "wilaya $etab->wilaya , commune $etab->commune" }}</li>
                
            </ul>
            autre infos:
            <ul>
                @if ($etab->fax)
                    <li>fax : $etab->fax</li>
                @endif
                @if ($etab->fix)
                    <li>fix : $etab->fix</li>
                @endif
                @if ($etab->email)
                    <li>email ou site : $etab->email</li>
                @endif
            </ul>
            <hr>
        @endif
        
        {{-- etat --}}
        <h4>Etat</h4>
        <form action="{{ route('admin.user.etat', $user) }}" method="POST" class="row">
            @csrf
            <div class="col-6">
                <select class="form-control selectpicker" name="etat" id="">
                    <option value="active" {{ ($user->etat === "active") ? "selected" : "" }} >active</option>
                    <option value="desactive" {{ ($user->etat === "desactive") ? "selected" : "" }} >desactive</option>
                </select>
            </div>
            <div class="col-6">
                <button class="btn btn-info">Changé etat</button>
            </div>
        </form>
        
        <hr>

        {{-- user infos --}}
        <h4>Utilisateur</h4>
        <form action="{{ route('admin.user.details', $user) }}" method="POST">
            @csrf
            <div class="row my-3" style="max-width: 600px;">
                <div class="col-4 mb-3">
                    <label for="">Nom</label>
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="text" name="nom" placeholder="{{ $user->nom }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Prenom</label>
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="text" name="prenom" placeholder="{{ $user->prenom }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Email</label>
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="email" name="email" placeholder="{{ $user->email }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Telephone</label>
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="text" name="phone" placeholder="{{ $user->phone }}">
                </div>
                @if ($user->type_user === "abonné")
                    <div class="col-4 mb-3">
                        <label for="">Entreprise</label>
                    </div>
                    <div class="col-8 mb-3">
                        <input class="form-control" type="text" name="nom_entreprise" placeholder="{{ $user->nom_entreprise }}">
                    </div>
                @endif
                <div class="col-4 mb-3">
                    <label for="">Wilaya</label>
                </div>
                <div class="col-8 mb-3">
                    <select class="wil1 form-control selectpicker" data-live-search="true" name="wilaya" id=""></select>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-info">Modifier</button>
            </div>
        </form>

        <hr>

        {{-- reset password --}}
        <h4>Mot de Passe</h4>
        <form action="{{ route('admin.user.password', $user) }}" method="POST">
            @csrf
            <div class="row my-3" style="max-width: 600px;">
                <div class="col-4 mb-3">
                    Nouveau mot de passe
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="col-4 mb-3">
                    Repetez mot de passe
                </div>
                <div class="col-8 mb-3">
                    <input class="form-control" type="password" name="password_confirmation">
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-info">Changer</button>
            </div>
        </form>

        @if ($user->type_user === "abonné")
            <hr>
            <h4>Nouvel Abonnement</h4>
            <form action="{{ route('admin.abonnement.store', $user) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Abonnement choisi</label>
                        <select class="form-control selectpicker" name="nom_abonnement" id="">
                            <option value="bronze">Bronze</option>
                            <option value="silver">Silver</option>
                            <option value="gold">Gold</option>
                            <option value="platine">Platine</option>
                            <option value="ultra">Ultra</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Secteurs</label>
                        <select name="secteurs[]" class="form-control mb-2 selectpicker" multiple title="Secteur" data-live-search="true" required>
                            @foreach (App\Models\Secteur::All() as $sect)
                                <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}">{{ $sect->secteur }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Date debut</label>
                        <input class="form-control" type="date" name="date_debut" value="{{ $date_debut }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Date fin</label>
                        <input class="form-control" type="date" name="date_fin" value="{{ date('Y-m-d', strtotime($date_debut . ' +1 years')) }}">
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-info">Renouvlé</button>
                </div>
            </form>

            <hr>

            <h4>Historique d'abonnement</h4>
            <table class="table">
                <tr>
                    <td>Nom Abonnement</td>
                    <td>Date debut</td>
                    <td>Date fin</td>
                    <td>Action</td>
                </tr>
                @foreach ($user->abonnement as $abonnement)
                    <tr>
                        <td>{{ $abonnement->nom_abonnement }}</td>
                        <td>{{ $abonnement->date_debut }}</td>
                        <td>{{ $abonnement->date_fin }}</td>
                        <td>
                            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $abonnement->id }}">Supprimer</a>
                            @if (new DateTime($abonnement->date_fin) >= new DateTime())
                                <button class="btn btn-warning" data-id="{{ $abonnement->id }}" onclick="edit_abonnement(this)">Edit</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>

            <div class="collapse" id="edit_form">
                <hr>
                <h4>Modifier Abonnement</h4>

                <form id="form_reset" action="{{ route('admin.abonnement.edit') }}" method="POST">
                    @csrf
                    <input id="abonnement_id" type="number" name="abonnement_id" hidden>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Abonnement choisi</label>
                            <select class="form-control" name="nom_abonnement" id="nom_abonnement">
                                <option value="bronze">Bronze</option>
                                <option value="silver">Silver</option>
                                <option value="gold">Gold</option>
                                <option value="platine">Platine</option>
                                <option value="ultra">Ultra</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Secteurs</label>
                            <select name="secteurs[]" class="form-control mb-2" multiple title="Secteur" data-live-search="true" id="secteurs">
                                @foreach (App\Models\Secteur::All() as $sect)
                                    <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}">{{ $sect->secteur }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Date debut</label>
                            <input id="date_debut" class="form-control" type="date" name="date_debut" value="">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="">Date fin</label>
                            <input id="date_fin" class="form-control" type="date" name="date_fin" value="">
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-info">Modifier</button>
                    </div>

                </form>
            </div>

        @endif

    </div>

            <!-- delete modal -->
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
              Voulez vous supprimer cet Abonnement?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">non</button>
              <form method="POST" action="{{ route('admin.abonnement.destroy') }}">
                  @csrf
                  @method('DELETE')
                  <input type="number" name="abonnement" id="abonnement_id" hidden>
                  <button class="btn btn-info">Oui</button>
              </form>
            </div>
          </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#exampleModalCenter').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
            
			$('#abonnement_id').val(id);
		});

        wilaya1();

        function edit_abonnement(e) {
            var id = $(e).data('id');
            // hide current form
            $("#edit_form").collapse('hide');

            $("#form_reset").trigger("reset");
            
            // get the date
            $.get("/admin/abonnement/"+id, function(data, status){
                if(status === 'success'){
                    // fill the form
                    $('#abonnement_id').val(data.id);
                    $('#nom_abonnement').val(data.nom_abonnement);
                    $('#date_debut').val(data.date_debut);
                    $('#date_fin').val(data.date_fin);
                    
                    var secteur = [];
                    for(var k in data.secteur){
                        secteur.push(data.secteur[k].id);
                    }
                    $('#secteurs').val(secteur);
                    $('#secteurs').selectpicker();

                    $("#edit_form").collapse('show');
                }
            });            

        }

    </script>

    @if ($user->wilaya)
        <script>
            $(".wil1").val("{{ $user->wilaya }}");
        </script>
    @endif
@endsection