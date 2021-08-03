@extends('layouts.layout')

@section('title', 'Detail Offre')
    
@section('content')
<div class="container main">
    <x-alert />
    <div class="row pt-5">
        <div class="col-md-3">
            <div class="text-center">
                <h6 class="bold mb-4">L’Annonceur:</h6>
                @if ($expired)
                    <img class="img-fluid mb-4" src="{{ asset('img/icons/lock3.png') }}">
                    <h6 class="bold mb-4">Réservé aux abonnés</h6>
                @else
                    @if ($offre->user->type_user === "abonné")
                        <img class="img-fluid mb-4" src="{{ asset('img/user.png') }}">
                    @elseif($img === "default")
                        <img class="img-fluid mb-4" src="{{ asset('img/2.png') }}">
                        <h6 class="bold mb-4">{{ $etab->nom_etablissement }}</h6>
                    @elseif ($img)
                    <img class="img-fluid mb-4 rounded-circle" src="{{ asset('storage/logo/' . $img) }}">
                    <h6 class="bold mb-4">{{ $etab->nom_etablissement }}</h6>
                    @endif
                @endif
                
            </div>
            <div>
                <div class="mb-2">
                    <span class="bold">Identifiant: </span>
                    {{ $offre->id }}
                </div>
                <div class="mb-2">
                    <span class="bold">Statut: </span>
                    {{ $offre->statut }}
                </div>
                <div class="mb-2">
                    <span class="bold">Type: </span>
                    {{ $offre->type }}
                </div>
                @if ($offre->wilaya)
                    <div class="mb-2">
                        <span class="bold">Wilaya: </span>
                        @if ($expired)
                            <img src="{{ asset('img/icons/lock.png') }}">
                            Réservé aux abonnés
                        @else
                            {{ $offre->wilaya }}
                        @endif         
                    </div>
                @endif

                @if (!$expired && $etab)
                    @if ($etab->fix)
                        <div class="mb-2">
                            <span class="bold">fix: </span>
                            {{ $etab->fix }}
                        </div>
                    @endif
                    @if ($etab->fax)
                        <div class="mb-2">
                            <span class="bold">fax: </span>
                            {{ $etab->fax }}
                        </div>
                    @endif
                    @if ($etab->email)
                        <div class="mb-2">
                            <span class="bold">Email ou siteweb: </span>
                            {{ $etab->email }}
                        </div>
                    @endif
                @endif

                <div class="mb-2">
                    <b>Date publication:</b>  {{ $offre->date_pub }}
                </div>
                <div class="mb-2">
                    <b>Date d'échéance:</b>  {{ $offre->date_limit }}
                </div>
                <div class="mb-2">
                    <b>Secteur</b>
                    <ul class="pl-2 mt-2" style="list-style: none;">
                        @foreach ($offre->secteur as $item)
                            <li>{{ $item->secteur }}</li>
                        @endforeach                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row mb-5">
                <div class="col-sm-11">
                    <h4 class="bold text-dark">{{ $offre->titre }}</h4>
                </div>
                @auth
                <form class="col-sm-1" method="POST" action="{{ route('favorit.toggle', $offre) }}">
                    @csrf
                    @if ($offre->isFavorited())
                        <button class="text-sm-right" style="background: none; border: none;">
                            <img src="{{ asset('img/icons/starfill.png') }}">
                        </button>
                    @else
                        <button class="text-sm-right" style="background: none; border: none;">
                            <img src="{{ asset('img/icons/star.png') }}">
                        </button>
                    @endif
                </form>
                @endauth
            </div>
            <div class="">
                @if ($offre->statut === "Appel d'offres & Consultation")
                    <div class="m-2">
                        <span>
                            <img class="mr-3" src="{{ asset('img/icons/indic.png') }}">
                            <b>Adress de retrait du cahier des charges: </b>

                            @if ($expired)
                                <img class="mx-2" src="{{ asset('img/icons/lock.png') }}">
                                Réservé aux abonnés
                            @else
                                bureau de marché de {{ $etab->category }} de la wilaya {{ $offre->wilaya }}
                            @endif
                        </span>
                    </div>
                    @if ($offre->prix)
                    <div class="m-2">
                        <span>
                            <img class="mr-3" src="{{ asset('img/icons/dollar.png') }}">
                            <b>Prix d’cahier d’charge: </b>
                            @if ($expired)
                                <img class="mx-2" src="{{ asset('img/icons/lock.png') }}">
                                Réservé aux abonnés
                            @else
                                {{ $offre->prix . " Dzd" }}
                            @endif
                            
                        </span>
                    </div>
                    @endif
                    
                @endif
            </div>
            
            @if (!$expired && $offre->description)
                <div class="my-4">
                    <p>
                        {!! nl2br(e($offre->description))!!}
                    </p>
                </div>
            @endif
            
            @if ($expired)
            <div class="my-4">
                <img class="img-fluid" src="{{ asset('img/exemple.png') }}">
            </div>
            @endif
            @if (!$expired)
                @if ($offre->img_offre)
                    <div class="my-4">
                        <img class="img-fluid" src="{{ asset('storage/' . $offre->img_offre) }}">
                    </div>
                @endif
                @if ($offre->img_offre2)
                    <div class="my-4">
                        <img class="img-fluid" src="{{ asset('storage/' . $offre->img_offre2) }}">
                    </div>
                @endif
               
            @endif

            @auth
                @if ($journal_ar || $journal_fr)
                    <div class="row mt-4">
                        @if ($journal_ar)
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('storage/journal/' . $journal_ar->logo) }}" alt="">
                            </div>
                        @endif

                        @if ($journal_fr)
                        <div class="col-md-4">
                            <img class="img-fluid" src="{{ asset('storage/journal/' . $journal_fr->logo) }}" alt="">
                        </div>
                        @endif
                    </div>
                @endif
            @endauth

            @guest
                <div class="my-4 text-center">
                    <button class="btn btn-lg btn-primary">
                        <b>Inscrivez-vous gratuitement</b>
                        <br>
                        avec 5 jours d’essai
                    </button>
                </div>
            @endguest
           
            <div class="my-4">
                La date de remise des offres est donnée à titre indicatif, veuillez confirmer la date réelle auprès de l’annonceur
            </div>
        </div>
    </div>		
</div>
@endsection