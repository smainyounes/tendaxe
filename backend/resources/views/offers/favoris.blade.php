@extends('layouts.layout')

@section('title', 'Favoris')

@section('content')
    <div class="container main">
        <x-alert />
        <h1 class="bold text-center">List favoris</h1>
        
        @if ($offres->count())
            @foreach ($offres as $offre)
                <x-offre :exp="$expired" :offre="$offre" />
            @endforeach
        @else
            <h3 class="text-center">Liste vide</h3>
        @endif
    
        {{-- {{ $offres->links() }} --}}
    </div>
   

@endsection