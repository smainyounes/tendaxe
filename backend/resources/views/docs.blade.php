@extends('layouts.layout')

@section('title', 'Documents utiles')

@section('content')
    <div class="container-fluid p-5" style="background: url({{ asset('img/banner/offers.jpg') }}) no-repeat center center; margin-top: 66px; background-size: cover;">
        <div class="container">
            <h3 class="text-white bold my-4">Documents utiles</h3>
        </div>
    </div>

    <div class="container mt-5">
        <h4 class="bold mb-3">DOCUMENTS TENDAXE</h4>

        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3">OFFRE DE SERVICE</span>
        </div>
        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3">TARIFICATION DES PRESTATIONS DE RETRAIT DES CDC.</span>
        </div>


        <h4 class="bold mt-5 mb-3">DOCUMENTS ADMINISTRATIFS</h4>

        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <div class="ml-3">
                <span class="">CODE DES MARCHÉS PUBLICS: </span>
                <br>
                <span class="text-muted" style="font-weight: lighter;">Decret presidentiel n°15-247 du 2 Dhou El Hidja 1436 correspondant au 16 septembre 2015</span>
            </div>
        </div>
        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3">MANUEL SUR LES RÈGLES DE L’ORIGINE DES MARCHANDISES DANS LE CADRE DE L'ACCORD D'ASSOCIATION ALGÉRIE UE</span>
        </div>
        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3">JOURNAL OFFICIEL DE LA RÉPUBLIQUE ALGÉRIENNE PUBLIÉ 23 DÉCEMBRE 2018</span>
        </div>

        <h4 class="bold mt-5 mb-3">DOCUMENTS ADMINISTRATIFS</h4>

        <p class="text-muted">Afin de vous assister à la préparation de vos offres (dossier technique, financier et candidature)</p>

        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3">MODEL DÉCLARATION À SOUSCRIRE</span>
        </div>

        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3">
                MODEL DÉCLARATION DE PROBITÉ
            </span>
        </div>

        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3">
                MODEL DÉCLARATION DE CANDIDATURE
            </span>
        </div>

        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3">
                MODEL LETTRE DE SOUMISSION
            </span>
        </div>

        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3">
                MODEL D’ENGAGEMENT D’INVESTISSEMENT
            </span>
        </div>

        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('img/icons/pdf.png') }}" alt="">
            <span class="ml-3">
                MODEL DÉCLARATION DE SOUS-TRAITANT
            </span>
        </div>

    </div>
@endsection