@extends('layouts.profile')
    
@section('profile')
    <div class="container-fluid">
        <h5 class="mb-4">Modifier mon profile</h5>
        <ul class="pl-3" style="list-style: none;">
            <li class="mb-2">Nom: 
                <span class="ml-3 bold">{{ Auth::user()->nom }}</span>
            </li>
            <li class="mb-2">Prenom: 
                <span class="ml-3 bold">{{ Auth::user()->prenom }}</span>
            </li>
            <li class="mb-2">Email: 
                <span class="ml-3 bold">{{ Auth::user()->email }}</span>
            </li>
            <li class="mb-2">Telephone: 
                <span class="ml-3 bold">{{ Auth::user()->phone }}</span>
            </li>
            <li class="mb-2">Nom de l'entreprise: 
                <span class="ml-3 bold">{{ Auth::user()->nom_entreprise }}</span>
            </li>
            <li class="mb-2">Wilaya: 
                <span class="ml-3 bold">{{ Auth::user()->wilaya }}</span>
            </li>
        </ul>

        <form action="{{ route('user.password') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Mot de passe actuel</label>
                <input class="form-control form-control-sm bg-light" type="password" name="old_password">
            </div>
            <div class="form-group">
                <label for="">Nouveau mot de passe</label>
                <input class="form-control form-control-sm bg-light" type="password" name="password">
            </div>
            <div class="form-group">
                <label for="">Confirmer Nouveau mot de passe</label>
                <input class="form-control form-control-sm bg-light" type="password" name="password_confirmtaion">
            </div>
            <div class="text-right">
                <button class="btn btn-primary">Modifier</button>
            </div>
        </form>

    </div>
@endsection