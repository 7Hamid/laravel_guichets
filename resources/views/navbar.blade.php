<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Guichet</title>
    <style>
        .navbar img {
            height: 50px; /* Adjust as needed */
            margin-left: 10px; /* Spacing */
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Guichet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">Qui sommes-nous?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('closedTickets') ? 'active' : '' }}" href="/closedTickets">Closed_Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tickets') ? 'active' : '' }}" href="/tickets">Tickets</a>
                    </li>
                </ul>

                <img src="{{ asset('assets/images/guichet_logo.png') }}" alt="Guichet Logo" class="mx-auto d-block">

                <form class="d-flex" role="search" action="/search" method="GET">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
