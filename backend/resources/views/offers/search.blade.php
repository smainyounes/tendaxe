@extends('layouts.layout')

@section('title', 'Offres')
    
@section('content')
    <div class="container main">
        <x-alert />
        <h1 class="bold text-center">List d’annonces</h1>
        <div class="text-right">
            @auth
                <a href="{{ route('offre.add') }}" class="btn btn-primary">Ajouter Offre</a>
            @endauth
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary">Ajouter Offre</a>
            @endguest
        </div>
        <div class="row">
            <div class="col-md-3">
                <form class="bg-white p-2 border mt-2" method="GET" action="{{ route('search') }}">
                    <div class="form-group">
                        <input class="form-control bg-light" type="text" name="keyword" placeholder="chercher">
                    </div>
                    <select name="wilaya" class="form-control mb-2 wil1 selectpicker" title="Region" data-live-search="true">
                    </select>
                    <select name="statut" class="form-control mb-2 selectpicker" title="statut" data-live-search="true">
                        <option value="Mise en demeure et résiliation" data-tokens="Mise en demeure et résiliation">Mise en demeure et résiliation</option>
                        <option value="Adjudication" data-tokens="Adjudication">Adjudication</option>
                        <option value="Vente aux enchères" data-tokens="Vente aux enchères">Vente aux enchères</option>
                        <option value="Infructuosité" data-tokens="Infructuosité">Infructuosité</option>
                        <option value="Annulation" data-tokens="Annulation">Annulation</option>
                        <option value="Attribution de marché" data-tokens="Attribution de marché">Attribution de marché</option>
                        <option value="Prorogation de délai" data-tokens="Prorogation de délai">Prorogation de délai</option>
                        <option value="Appel d'offres & Consultation" data-tokens="Appel d'offres & Consultation">Appel d'offres & Consultation</option>
                    </select>
                    <select name="secteur[]" class="form-control mb-2 selectpicker" multiple title="Secteur" data-live-search="true">
                        @if ($secteurs)
                            @foreach ($secteurs as $sect)
                                <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}" >{{ $sect->secteur }}</option>
                            @endforeach
                        @endif                       
                    </select>
                    <select name="type" class="form-control mb-2 selectpicker" title="Type" data-live-search="true">
                        <option value="national" data-tokens="national">National</option>
                        <option value="international" data-tokens="international">Internation</option>
                    </select>
                    <hr>
                    <select class="form-control mb-2 selectpicker" name="pub" title="Date de publication" data-live-search="false">
                        <option value="today">Ajourdhui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="3months">derniers 3 mois</option>
                    </select>
                    <select class="form-control mb-2 selectpicker" name="limit" title="Date limit" data-live-search="false">
                        <option value="today">Ajourdhui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="3months">derniers 3 mois</option>
                    </select>

                    <button type="submit" class="btn btn-primary w-100">Chercher</button>

                </form>
            </div>
            <div class="col-md-9">
                @if ($offres->count())
                    @foreach ($offres as $offre)
                        <x-offre :exp="$expired" :offre="$offre" />
                    @endforeach
                @else
                    <h3 class="text-center">Pas de resultat</h3>
                @endif

                {{ $offres->links() }}
            </div>
        </div>
    </div>

    <script type="text/javascript">
        wilaya1(09);
    </script>
@endsection