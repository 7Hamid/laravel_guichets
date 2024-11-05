<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if ($tickets->isEmpty())
            <div class="col-md-12">
                <div class="alert alert-warning text-center">
                    <strong>Aucun ticket disponible.</strong>
                </div>
            </div>
        @else
            @foreach ($tickets as $ticket)
                <div class="col-md-3 mb-4 mt-4">
                    <div class="card position-relative">
                        @if ($ticket->image)
                            <img src="{{ asset('storage/' . $ticket->image) }}" alt="Image du Ticket {{ $ticket->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="default-image-url.jpg" alt="Image par défaut" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif

                        <!-- Label "Expiré" -->
                        <div class="expired-label">Expiré</div>

                        <div class="card-body">
                            <div class="w-70 mx-auto">
                                <p class="mt-1 text-center text-white bg-black rounded">{{ $ticket->categorie }}</p>
                            </div>
                            <h5 class="card-title">{{ $ticket->title }}</h5>
                            <p><i class="fa-solid fa-location-dot"></i> {{ $ticket->adresse }}</p>
                            <div id="buttons-{{ $ticket->id }}" class="row">
                                <p><strong><span style="text-transform: uppercase">à</span> partir de: </strong>
                                    <b><strong class="text-danger">{{ number_format($ticket->prix, 2, ',', ' ') }} {{ $ticket->devise }}</strong></b>
                                </p>
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-danger">Voir Détails</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<style>
    .expired-label {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(255, 0, 0, 0.8); /* Rouge transparent */
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
        z-index: 1;
    }
</style>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
