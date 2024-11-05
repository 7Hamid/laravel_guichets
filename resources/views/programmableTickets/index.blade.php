@extends('layouts.app')

@section('content')

    <script>
        function startCountdown(eventDateTime, ticketId) {
            var eventDate = new Date(eventDateTime).getTime();
            var countdownElement = document.getElementById("countdown-" + ticketId);
            var interval = setInterval(function() {
                var now = new Date().getTime();
                var distance = eventDate - now;

                // Calculating time units
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
                startCountdown("{{ $ticket->scheduled_date }}T{{ $ticket->scheduled_time }}", "{{ $ticket->id }}");
            @endforeach

        };
    </script>
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
                                <img src="{{ asset('storage/' . $ticket->image) }}" alt="Image du Ticket {{ $ticket->title }}"
                                    class="card-img-top" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="default-image-url.jpg" alt="Image par défaut" class="card-img-top"
                                    style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <div class="text-center mb-2">
                                    <p class="text-white bg-black rounded p-1">{{ $ticket->categorie }}</p>
                                </div>
                                <h5 class="card-title">{{ $ticket->title }}</h5>
                                <p><i class="fa-solid fa-location-dot"></i> <a style="text-decoration: none;color:black"
                                        href="{{ $ticket->localisation }}" target="blank"> <b>{{ $ticket->adresse }}</b></a>
                                </p>

                                <div id="countdown-{{ $ticket->id }}" class="d-flex justify-content-center gap-2 mt-3">
                                    <div class="text-center">
                                        <div id="days-countdown-{{ $ticket->id }}"
                                            class="rounded-circle border border-danger d-flex align-items-center justify-content-center"
                                            style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">
                                            0</div>
                                        <p class="mb-0">Jours</p>
                                    </div>
                                    <div class="text-center">
                                        <div id="hours-countdown-{{ $ticket->id }}"
                                            class="rounded-circle border border-danger d-flex align-items-center justify-content-center"
                                            style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">
                                            0</div>
                                        <p class="mb-0">Heures</p>
                                    </div>
                                    <div class="text-center">
                                        <div id="minutes-countdown-{{ $ticket->id }}"
                                            class="rounded-circle border border-danger d-flex align-items-center justify-content-center"
                                            style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">
                                            0</div>
                                        <p class="mb-0">Minutes</p>
                                    </div>
                                    <div class="text-center">
                                        <div id="seconds-countdown-{{ $ticket->id }}"
                                            class="rounded-circle border border-danger d-flex align-items-center justify-content-center"
                                            style="width: 45px; height: 45px; background-color: #f0f0f0; font-size: 12px; font-weight: bold; color: #333;">
                                            0</div>
                                        <p class="mb-0">Secondes</p>
                                    </div>
                                </div>

                                <div id="buttons-{{ $ticket->id }}" class="row mt-2">
                                    <p><strong><span style="text-transform: uppercase">à</span> partir de: </strong>
                                        <b><strong class="text-danger">{{ number_format($ticket->prix, 2, ',', ' ') }}
                                                {{ $ticket->devise }}</strong></b>
                                    </p>
                                    <p><strong> VIP <span style="text-transform: uppercase">à</span> partir de: </strong>
                                        <b><strong class="text-danger">{{ number_format($ticket->prix_vip, 2, ',', ' ') }}
                                                {{ $ticket->devise }}</strong></b>
                                    </p>
                                    <a href="{{ route('programmableTickets.show', $ticket->id) }}"
                                        class="btn btn-danger">Voir Détails</a>
                                </div>

                                <div id="closed-{{ $ticket->id }}" class="btn btn-secondary w-100 mt-2"
                                    style="display: none;">
                                    Guichet Fermé
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
