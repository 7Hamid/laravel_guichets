<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

<style>
    .countdown-circle {
        text-align: center;
    }

    .circle-number {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        border: 3px solid #e60000;
    }

    .card-body img {
        max-width: 100%;
        height: auto;
    }

    .related-slider .slick-prev,
    .related-slider .slick-next {
        color: #333;
    }

    .related-slider .slick-prev:before,
    .related-slider .slick-next:before {
        color: #333;
    }

    .related-slider img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    /* Espacement entre les slides */
    .related-slider .slick-slide {
        margin: 0 10px; /* Ajuste l'espacement ici */
    }
</style>

<script>
    var eventDateTime = new Date("{{ $ticket->event_date }}T{{ $ticket->event_time }}").getTime();

    function startCountdown() {
        var countdownElement = document.getElementById("countdown");
        var buyButton = document.getElementById("buy-button");
        var contactButton = document.getElementById("contact-button");
        var closedButton = document.getElementById("closed-button");

        var interval = setInterval(function () {
            var now = new Date().getTime();
            var distance = eventDateTime - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;

            if (distance < 0) {
                clearInterval(interval);
                countdownElement.innerHTML = "L'événement a expiré!";

                buyButton.style.display = 'none';
                contactButton.style.display = 'none';
                closedButton.style.display = 'block';
            }
        }, 1000);
    }

    window.onload = startCountdown;

    document.addEventListener('DOMContentLoaded', function () {
        $('.related-slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1000,
            dots: true,
            arrows: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
</script>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Ticket Card (Left Side) -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <strong>{{ $ticket->title }}</strong>
                </div>
                <div class="card-body">
                    @if ($ticket->image)
                        <img src="{{ asset('storage/' . $ticket->image) }}" alt="Image du Ticket {{ $ticket->title }}">
                    @else
                        <p>Aucune image disponible.</p>
                    @endif
                    <div class="w-50 mx-auto">
                        <p class="mt-1 text-center text-white bg-black rounded">{{ $ticket->categorie }}</p>
                    </div>
                    <p><i class="fa-solid fa-location-dot"></i> {{ $ticket->adresse }}</p>
                    <div id="countdown" style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
                        <div class="countdown-circle">
                            <div id="days" class="circle-number"></div>
                            <p>Jours</p>
                        </div>
                        <div class="countdown-circle">
                            <div id="hours" class="circle-number"></div>
                            <p>Heures</p>
                        </div>
                        <div class="countdown-circle">
                            <div id="minutes" class="circle-number"></div>
                            <p>Minutes</p>
                        </div>
                        <div class="countdown-circle">
                            <div id="seconds" class="circle-number"></div>
                            <p>Secondes</p>
                        </div>
                    </div>
                    <p><strong>À partir de :</strong> <span class="text-danger">{{ number_format($ticket->prix, 2, ',', ' ') }} €</span></p>
                    <div class="d-flex justify-content-between">
                        <div id="buy-button">
                            <a class="btn btn-danger" href="tel:{{$ticket->phone}}">J'achète</a>
                        </div>
                        <div id="contact-button">
                            <a class="btn btn-danger" href="{{ route('contact.create', ['ticket_id' => $ticket->id]) }}">Contacter</a>
                        </div>
                        <div id="closed-button" style="display: none;">
                            <button class="btn btn-secondary" disabled>Guichet fermé</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description (Right Side) -->
        <div class="col-md-8">
            @if ($ticket->image)
                <img src="{{ asset('storage/' . $ticket->image) }}" class="img-fluid d-none d-md-block" alt="Image du Ticket {{ $ticket->title }}" style="width: 700px; height: 350px;">
            @else
                <p>Aucune image disponible.</p>
            @endif
            <p class="mt-5"><strong>Description :</strong>{!! $ticket->description !!}</p>
        </div>

    </div>

    <!-- Related Tickets Slider (Below) -->
    <div class="row mt-5">
        <div class="col-md-12 gap-20">
            <h2>Autres événements</h2>
            <div class="related-slider">
                @if($relatedTickets->isEmpty())
                    <p>No related tickets available.</p>
                @else
                    @foreach ($relatedTickets as $relatedTicket)
                        <div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="text-center"><strong>{{ $relatedTicket->title }}</strong></div>
                                </div>
                                <div class="card-body">
                                    @if ($relatedTicket->image)
                                        <img src="{{ asset('storage/' . $relatedTicket->image) }}" alt="Image of {{ $relatedTicket->title }}">
                                    @endif
                                    <p class="mt-3"><strong><span style="text-transform: uppercase">à</span> partir de :</strong> <b class="text-danger">{{ number_format($relatedTicket->prix, 2, ',', ' ') }} {{ $ticket->devise }}</b></p>
                                    <a href="{{ route('tickets.show', $relatedTicket->id) }}" class="btn btn-primary">Voir les détails</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
@endsection
