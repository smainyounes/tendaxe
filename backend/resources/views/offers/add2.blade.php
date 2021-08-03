@extends('layouts.layout')

@section('title', 'Publier')

@section('content')
    <div class="container main">
        <h2 class="text-center bold">Publier une annonce</h2>
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
        <div class="bg-white p-3 border my-4">
            <form action="{{ route('offre.add') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Intitulé de Projet</label>
                    <input class="form-control bg-light" type="text" name="titre" required>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control bg-light" style="resize: none;" name="description" id="" rows="6"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Wilaya</label>
                        <select onchange="test()" name="wilaya" required class="form-control mb-2 wil1 selectpicker" data-live-search="true"></select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Commune</label>
                        <div class="com-container">
                            <select name="commune" required class="form-control mb-2 com1" data-live-search="true"></select>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Date publication</label>
                        <input class="form-control bg-light" type="date">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Date d'échéance</label>
                        <input class="form-control bg-light" type="date">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Secteurs</label>
                        <select name="secteur[]" class="form-control mb-2 selectpicker" multiple title="Secteur" data-live-search="true" required>
                            @foreach (App\Models\Secteur::All() as $sect)
                                <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}" >{{ $sect->secteur }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary">Publier</button>
                </div>
            </form>
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