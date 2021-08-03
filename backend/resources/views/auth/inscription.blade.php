@extends('layouts.layout')

@section('title', 'Inscription')
    
@section('content')
    <div class="container main">
        <h2 class="bold text-center">Inscription</h2>
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
        <div class="row my-5 justify-content-center">
            <div class="col-sm-10">
                <form class="bg-white border px-4 pt-3 rounded" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control bg-light" type="email" name="email" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom</label>
                                <input class="form-control bg-light" type="text" name="nom" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prenonom</label>
                                <input class="form-control bg-light" type="" name="prenom" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mot de passe</label>
                                <input class="form-control bg-light" type="password" name="password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Repeter votre mot de passe</label>
                                <input class="form-control bg-light" type="password" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom de l’entreprise</label>
                                <input class="form-control bg-light" type="text" name="nom_entreprise" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telephone</label>
                                <input class="form-control bg-light" type="text" name="phone" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Wilaya</label>
                                <select onchange="test()" name="wilaya" required class="form-control mb-2 wil1 selectpicker" data-live-search="true">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Commune</label>
                                <div class="com-container">
                                    <select name="commune" required class="form-control mb-2 com1" data-live-search="true"></select>                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary">Inscription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        wilaya1(09);
        commune11(09);
        $('.com1').selectpicker();
        
        function test() {
            var t = $('.wil1').find(":selected").data("id");
            $(".com-container").html('<select name="commune" required class="form-control mb-2 com1" data-live-search="true"></select>');
            commune11(t);
            $('.com1').selectpicker();
        }

    </script>
@endsection