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

    <div class="row">
        <div class="col-md-6 p-3">
            <div class="container-fluid bg-white py-3">
                <h4>Info user</h4>
                <ul>
                    <li>fullname : {{ "$user->nom $user->prenom" }}</li>
                    <li>email : {{ "$user->email" }}</li>
                    <li>phone : {{ "$user->phone" }}</li>
                    @if (!$etab)
                    <li>emplacement : {{ "wilaya $user->wilaya , commune $user->commune" }}</li>

                    @if ($user->exp)
                        <li>date exp : {{ "$user->exp" }}</li>
                    @endif
                    <li>etat : {{ "$user->etat" }}</li>
                    
                    
                        @if ($user->type_user === "abonné")
                            <hr>
                            list secteurs abonné
                            @foreach ($user->secteur as $secteur)
                                <li>{{ $secteur->secteur }}</li>
                            @endforeach
                            
                        @endif
                    @endif
                </ul>

                
            </div>
            <hr>
            <div class="container-fluid bg-white py-3">
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
            </div>
            <hr>
            <div class="container-fluid bg-white py-3">
                <form action="{{ route('admin.user.password', $user) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Repeter Password</label>
                        <input class="form-control" type="password" name="password_confirmation" required>
                    </div>

                    <button class="btn btn-info">Changer</button>
                </form>
            </div>
        </div>
        
        @if ($user->type_user === "abonné")
            <div class="col-md-6 p-3">
                <div class="container-fluid bg-white py-3">
                    <form action="{{ route('admin.user.secteurs', $user) }}" method="POST">
                        @csrf
                        <label for="">change secteurs</label>
                        <select name="secteur[]" class="form-control mb-2 selectpicker" multiple title="Secteur" data-live-search="true" required>
                            @foreach (App\Models\Secteur::All() as $sect)
                                <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}" {{ (in_array($sect->id, $secteurs)) ? "selected" : "" }}>{{ $sect->secteur }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-info">submit</button>
                    </form>
                </div>
                <div class="container-fluid bg-white py-3 mt-3">
                    <form action="{{ route('admin.user.exp', $user) }}" method="POST">
                        @csrf
                        <label for="">date exp</label>
                        <select class="form-control mb-2 selectpicker" onchange="test(this)" name="exp_choice" id="">
                            <option value="year">Ajouter 1 ans</option>
                            <option value="autre">autre</option>
                        </select>
                        <div class="form-group" id="custom_date" style="display: none;">
                            <input class="form-control" type="date" name="exp_custom" id="" value="{{ $user->exp }}">
                        </div>
                        <button class="btn btn-info">Ajouter</button>
                    </form>
                </div>
            </div>
        @endif

        @if ($etab)
            <div class="col-md-6 p-3">
                <div class="container-fluid bg-white py-3">
                    <h4>Info etablissement</h4>
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
                </div>
            </div>
        @endif
    </div>

    <script>
        function test(e) {
            if(e.value === 'autre'){
                $("#custom_date").show();
            }else{
                $("#custom_date").hide();
            }
        }
    </script>

@endsection