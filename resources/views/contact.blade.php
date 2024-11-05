@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Contactez-nous</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Numéro de téléphone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="promo_code" class="form-label">Code Promo</label>
                            <input type="number" class="form-control" id="promo_code" name="promo_code">
                        </div>

                        <div class="mb-3">
                            <label for="ticket" class="form-label">Evénement Choisi</label>
                            <select class="form-select" id="ticket" name="ticket" required>
                                <option value="" selected disabled>Choisissez un ticket</option>
                                @if(isset($ticket))
                                    <option value="{{ $ticket->id }}" selected>{{ $ticket->title }}</option>
                                @else
                                    <option value="formations">formations</option>
                                @endif
                            </select>

                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger">Envoyer la demande</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
