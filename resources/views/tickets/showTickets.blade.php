@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-3 my-5">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCategories" aria-controls="navbarCategories" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCategories">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach ($categories->take(8)  as $categorie)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tickets.filter', $categorie->name) }}" style="margin-right: 20px;">
                            <b>{{ $categorie->name }}</b>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>

<script>
    function startCountdown(eventDateTime, ticketId) {
        var eventDate = new Date(eventDateTime).getTime();
        var countdownElement = document.getElementById("countdown-" + ticketId);
        var interval = setInterval(function() {
            var now = new Date().getTime();
            var distance = eventDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days-countdown-" + ticketId).innerHTML = days;
            document.getElementById("hours-countdown-" + ticketId).innerHTML = hours;
            document.getElementById("minutes-countdown-" + ticketId).innerHTML = minutes;
            document.getElementById("seconds-countdown-" + ticketId).innerHTML = seconds;

            if (distance < 0) {
                clearInterval(interval);
                countdownElement.innerHTML = "L'événement est expiré!";
                document.getElementById("buttons-" + ticketId).style.display = "none";
                document.getElementById("closed-" + ticketId).style.display = "block";
            }
        }, 1000);
    }

    window.onload = function() {
        @foreach ($tickets as $ticket)
            startCountdown("{{ $ticket->event_date }}T{{ $ticket->event_time }}", "{{ $ticket->id }}");
        @endforeach
        @foreach ($programmableTickets as $ticket)
            startCountdown("{{ $ticket->event_date }}T{{ $ticket->event_time }}", "{{ $ticket->id }}");
        @endforeach
    };
</script>

<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">
    <i class="fa-solid fa-filter"></i> Filtrer par catégories
</button>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasLabel">Filter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form method="get">
            <div class="mb-3">
                <label for="title" class="form-label">By Name</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Entrez une chaîne de caractères">
            </div>
            <div class="mb-3">
                <label class="form-label">By Categories</label>
                @foreach ($categories as $categorie)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $categorie->name }}" id="category-{{ $categorie->id }}">
                        <label class="form-check-label" for="category-{{ $categorie->id }}">
                            {{ $categorie->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="mb-2">
                <input type="submit" class="btn btn-primary w-100" value="Rechercher">
            </div>
        </form>
    </div>
</div>

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
                    <div class="card">
                        @if ($ticket->image)
                            <img src="{{ asset('storage/' . $ticket->image) }}" alt="Image du Ticket {{ $ticket->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="default-image-url.jpg" alt="Image par défaut" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <div class="text-center mb-2">
                                <p class="text-white bg-black rounded p-1">{{ $ticket->categorie }}</p>
                            </div>
                            <h5 class="card-title">{{ $ticket->title }}</h5>
                            <p><i class="fa-solid fa-location-dot"></i> <a style="text-decoration: none;color:black" href="{{$ticket->localisation}}" target="blank"> <b>{{ $ticket->adresse }}</b></a></p>

                            <div id="countdown-{{ $ticket->id }}" class="d-flex justify-content-center gap-2 mt-3">
                                <div class="text-center">
                                    <div id="days-countdown-{{ $ticket->id }}" class="rounded-circle border border-danger d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">0</div>
                                    <p class="mb-0">Jours</p>
                                </div>
                                <div class="text-center">
                                    <div id="hours-countdown-{{ $ticket->id }}" class="rounded-circle border border-danger d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">0</div>
                                    <p class="mb-0">Heures</p>
                                </div>
                                <div class="text-center">
                                    <div id="minutes-countdown-{{ $ticket->id }}" class="rounded-circle border border-danger d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">0</div>
                                    <p class="mb-0">Minutes</p>
                                </div>
                                <div class="text-center">
                                    <div id="seconds-countdown-{{ $ticket->id }}" class="rounded-circle border border-danger d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">0</div>
                                    <p class="mb-0">Secondes</p>
                                </div>
                            </div>

                            <div id="buttons-{{ $ticket->id }}" class="row mt-2">
                                <p><strong><span style="text-transform: uppercase">à</span> partir de: </strong>
                                    <b><strong class="text-danger">{{ number_format($ticket->prix, 2, ',', ' ') }} {{ $ticket->devise }}</strong></b>
                                </p>
                                <p><strong> VIP <span style="text-transform: uppercase">à</span> partir de: </strong>
                                    <b><strong class="text-danger">{{ number_format($ticket->prix_vip, 2, ',', ' ') }} {{ $ticket->devise }}</strong></b>
                                </p>
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-danger">Voir  ST</a>
                            </div>

                            <div id="closed-{{ $ticket->id }}" class="btn btn-secondary w-100 mt-2" style="display: none;">
                                Guichet Fermé
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        @foreach ($programmableTickets as $ticket)
            <!-- Similar structure for programmable tickets if needed -->
            <div class="col-md-3 mb-4 mt-4">
                <div class="card">
                    @if ($ticket->image)
                        <img src="{{ asset('storage/' . $ticket->image) }}" alt="Image du Ticket {{ $ticket->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="default-image-url.jpg" alt="Image par défaut" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <div class="text-center mb-2">
                            <p class="text-white bg-black rounded p-1">{{ $ticket->categorie }}</p>
                        </div>
                        <h5 class="card-title">{{ $ticket->title }}</h5>
                        <p><i class="fa-solid fa-location-dot"></i> <a style="text-decoration: none;color:black" href="{{$ticket->localisation}}" target="blank"> <b>{{ $ticket->adresse }}</b></a></p>

                        <div id="countdown-{{ $ticket->id }}" class="d-flex justify-content-center gap-2 mt-3">
                            <div class="text-center">
                                <div id="days-countdown-{{ $ticket->id }}" class="rounded-circle border border-danger d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">0</div>
                                <p class="mb-0">Jours</p>
                            </div>
                            <div class="text-center">
                                <div id="hours-countdown-{{ $ticket->id }}" class="rounded-circle border border-danger d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">0</div>
                                <p class="mb-0">Heures</p>
                            </div>
                            <div class="text-center">
                                <div id="minutes-countdown-{{ $ticket->id }}" class="rounded-circle border border-danger d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">0</div>
                                <p class="mb-0">Minutes</p>
                            </div>
                            <div class="text-center">
                                <div id="seconds-countdown-{{ $ticket->id }}" class="rounded-circle border border-danger d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">0</div>
                                <p class="mb-0">Secondes</p>
                            </div>
                        </div>

                        <div id="buttons-{{ $ticket->id }}" class="row mt-2">
                            <p><strong><span style="text-transform: uppercase">à</span> partir de: </strong>
                                <b><strong class="text-danger">{{ number_format($ticket->prix, 2, ',', ' ') }} {{ $ticket->devise }}</strong></b>
                            </p>
                            <p><strong> VIP <span style="text-transform: uppercase">à</span> partir de: </strong>
                                <b><strong class="text-danger">{{ number_format($ticket->prix_vip, 2, ',', ' ') }} {{ $ticket->devise }}</strong></b>
                            </p>
                            <a href="{{ route('programmableTickets.show', $ticket->id) }}" class="btn btn-danger">Voir Détails PT</a>
                        </div>

                        <div id="closed-{{ $ticket->id }}" class="btn btn-secondary w-100 mt-2" style="display: none;">
                            Guichet Fermé
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
