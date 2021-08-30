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
                <form class="bg-white p-2 border rounded mt-2" method="GET" action="{{ route('search') }}">
                    {{-- <div class="form-group">
                        <input class="form-control bg-light" type="text" name="keyword" placeholder="mot clé">
                    </div> --}}
                    <div class="input-group mb-2">
                        <input type="text" class="form-control bg-light" placeholder="Mot clé" name="keyword" value="{{ old('keyword') }}">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-primary" type="button" id="button-addon2">
                              <img src="{{ asset('img/icons/search2.png') }}" alt="">
                          </button>
                        </div>
                      </div>
                      
                    <select name="wilaya[]" class="form-control mb-2 wil1 selectpicker" multiple data-style="btn-white" data-size="5" title="Toutes les wilayas" data-live-search="true">
                    </select>
                    <select name="statut[]" class="form-control mb-2 selectpicker" multiple data-style="btn-white" title="statut">
                        <option value="Mise en demeure et résiliation" data-tokens="Mise en demeure et résiliation">Mise en demeure et résiliation</option>
                        <option value="Adjudication" data-tokens="Adjudication">Adjudication</option>
                        <option value="Vente aux enchères" data-tokens="Vente aux enchères">Vente aux enchères</option>
                        <option value="Infructuosité" data-tokens="Infructuosité">Infructuosité</option>
                        <option value="Annulation" data-tokens="Annulation">Annulation</option>
                        <option value="Attribution de marché" data-tokens="Attribution de marché">Attribution de marché</option>
                        <option value="Prorogation de délai" data-tokens="Prorogation de délai">Prorogation de délai</option>
                        <option value="Appel d'offres & Consultation" data-tokens="Appel d'offres & Consultation">Appel d'offres & Consultation</option>
                    </select>
                    <select name="secteur[]" class="form-control mb-2 selectpicker" data-dropup-auto="false" data-style="btn-white" multiple title="Secteur" data-live-search="true">
                        @if ($secteurs)
                            @foreach ($secteurs as $sect)
                                <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}" >{{ $sect->secteur }}</option>
                            @endforeach
                        @endif                       
                    </select>
                    <select name="type" class="form-control mb-2 selectpicker"data-style="btn-white" title="Type">
                        <option value="national" data-tokens="national">National</option>
                        <option value="international" data-tokens="national et international">National & International</option>
                    </select>
                    <div class="form-group mb-2">
                        <input class="bg-light form-control" type="text" name="annonceur" placeholder="Annonceur" value="{{ old('annonceur') }}">
                    </div>
                    
                    <select class="form-control mb-2 selectpicker" onchange="customDate(this, 'pub')" name="pub" title="Date de publication" data-live-search="false">
                        <option value="today">Ajourdhui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="custom">Personalisé</option>
                    </select>

                    <div class="collapse mb-2" id="pub">
                        <input class="form-control" type="date" name="custom_pub">
                    </div>
                      
                    <select class="form-control mb-2 selectpicker" onchange="customDate(this, 'limit')" name="limit" title="Date limit" data-live-search="false">
                        <option value="today">Ajourdhui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="custom">Personalisé</option>
                    </select>

                    <div class="collapse mb-2" id="limit">
                        <input class="form-control" type="date" name="custom_limit">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Rechercher</button>

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
        wilaya1();
        $(".wil1 option[value='Aucun']").remove();
        $(".wil1").selectpicker('refresh');

        function customDate(e, type) {

            if(type === "pub"){
                var target = $('#pub');
            }else{
                var target = $('#limit');
            }

            if(e.value === 'custom'){
                target.collapse('show');
            }else{
                target.collapse('hide');
            }
        }
    </script>
@endsection