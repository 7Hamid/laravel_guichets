@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <!-- Ticket image -->
            @if ($ticket->image)
                <img src="{{ asset('storage/' . $ticket->image) }}" alt="Image du Ticket {{ $ticket->title }}" class="img-fluid rounded">
            @else
                <img src="default-image-url.jpg" alt="Image par défaut" class="img-fluid rounded">
            @endif

            <!-- Ticket details -->
            <h2 class="mt-4">{{ $ticket->title }}</h2>
            <p class="text-muted">{{ $ticket->categorie }}</p>
            <p>{{ $ticket->description }}</p>

            <hr>

            <h5>Détails de l'Événement</h5>
            <p><strong>Adresse:</strong> {{ $ticket->adresse }}</p>
            <p><strong>Localisation:</strong> <a href="{{ $ticket->localisation }}" target="_blank">{{ $ticket->localisation }}</a></p>
            <p><strong>Date et Heure:</strong> {{ $ticket->event_date }} à {{ $ticket->event_time }}</p>
            <p><strong>Numéro de Téléphone:</strong> {{ $ticket->phone }}</p>

            <hr>

            <h5>Tarification</h5>
            <p><strong>Prix Standard:</strong> {{ number_format($ticket->prix, 2, ',', ' ') }} {{ $ticket->devise }}</p>
            <p><strong>Prix VIP:</strong> {{ number_format($ticket->prix_vip, 2, ',', ' ') }} {{ $ticket->devise }}</p>
        </div>

        <!-- Countdown timer -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Décompte avant l'Événement</h5>
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
                    <div id="closed-{{ $ticket->id }}" class="btn btn-secondary w-100 mt-4" style="display: none;">
                        Guichet Fermé
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                document.getElementById("closed-" + ticketId).style.display = "block";
            }
        }, 1000);
    }

    document.addEventListener("DOMContentLoaded", function() {
        startCountdown("{{ $ticket->event_date }}T{{ $ticket->event_time }}", "{{ $ticket->id }}");
    });
</script>

@endsection
