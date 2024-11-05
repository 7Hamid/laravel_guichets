@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Scheduled Ticket</h2>
        <form action="{{ route('programmableTickets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Form fields from the provided code -->
            <div class="form-group">
                <label for="title" class="fw-bold">Titre:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <br>
            <div class="form-group">
                <label for="description"class="fw-bold">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $ticket->description ?? '') }}</textarea>
            </div>

            <br>
            <!-- Additional form fields -->

            <div class="row">
                <div class="col">
                    <label for="adresse"class="fw-bold">Adresse:</label>
                    <select name="adresse" id="adresse" class="form-control">
                        <option value="">Choisissez une adresse ...</option>
                        <option value="casablanca"
                            {{ old('adresse', $ticket->adresse ?? '') == 'casablanca' ? 'selected' : '' }}>casablanca
                        </option>
                        <option value="rabat" {{ old('adresse', $ticket->adresse ?? '') == 'rabat' ? 'selected' : '' }}>
                            rabat</option>
                        <option value="marrakech"
                            {{ old('adresse', $ticket->adresse ?? '') == 'marrakech' ? 'selected' : '' }}>marrakech</option>
                        <option value="agadir" {{ old('adresse', $ticket->adresse ?? '') == 'agadir' ? 'selected' : '' }}>
                            agadir</option>
                        <option value="meknes" {{ old('adresse', $ticket->adresse ?? '') == 'meknes' ? 'selected' : '' }}>
                            meknes</option>
                        <option value="fes" {{ old('adresse', $ticket->adresse ?? '') == 'fes' ? 'selected' : '' }}>fes
                        </option>
                        <option value="el_jadida"
                            {{ old('adresse', $ticket->adresse ?? '') == 'el_jadida' ? 'selected' : '' }}>el_jadida</option>
                        <option value="bnslimane"
                            {{ old('adresse', $ticket->adresse ?? '') == 'bnslimane' ? 'selected' : '' }}>bnslimane</option>
                    </select>
                </div><br>
                <div class="col">
                    <label for="localisation"class="fw-bold">Localisation:</label>
                    <input type="text" name="localisation" id="localisation" class="form-control"
                        value="{{ old('localisation', $ticket->localisation ?? '') }}" required>
                </div>
            </div>

            <br>
            <div class="form-group">
                <label for="categorie"class="fw-bold">Catégorie:</label>
                <select name="categorie" id="categorie" class="form-control" required>
                    <option value="">Choisissez une catégorie ...</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}"
                            {{ old('categorie', $ticket->categorie ?? '') == $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            <br>

            <div class="form-group">
                <label for="phone"class="fw-bold">phone:</label>
                <input type="tel" step="10" id="phone" name="phone" class="form-control"
                    value="{{ old('phone', $ticket->phone ?? '') }}" required>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="prix"class="fw-bold">Prix:</label>
                    <input type="number" step="10" id="prix" name="prix" class="form-control"
                        value="{{ old('prix', $ticket->prix ?? '') }}" required>
                </div>

                <div class="col">
                    <label for="prix_vip"class="fw-bold">Prix VIP:</label>
                    <input type="number" step="10" id="prix_vip" name="prix_vip" class="form-control"
                        value="{{ old('prix_vip', $ticket->prix_vip ?? '') }}" required>
                </div>



                <div class="col">
                    <label for="devise"class="fw-bold">Devise:</label>
                    <select name="devise" id="devise" class="form-control">
                        <option value="">Choisissez une devise ...</option>
                        <option value="$" {{ old('devise', $ticket->devise ?? '') == '$' ? 'selected' : '' }}>dollar
                        </option>
                        <option value="€" {{ old('devise', $ticket->devise ?? '') == '€' ? 'selected' : '' }}>euro
                        </option>
                        <option value="MAD" {{ old('devise', $ticket->devise ?? '') == 'MAD' ? 'selected' : '' }}>dirham
                        </option>
                        <option value="fcfa" {{ old('devise', $ticket->devise ?? '') == 'fcfa' ? 'selected' : '' }}>franc
                        </option>
                    </select>

                </div>
            </div>
            <br>
            <br>

            <div class="row">
                <div class="col">
                    <label for="event_date" class="fw-bold">Date de l'événement:</label>
                    <input type="date" name="event_date" id="event_date" class="form-control" required>
                </div>
                <div class="col">
                    <label for="event_time" class="fw-bold">Heure de l'événement:</label>
                    <input type="time" name="event_time" id="event_time" class="form-control" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="scheduled_date" class="fw-bold">Date de publication:</label>
                    <input type="date" name="scheduled_date" id="scheduled_date" class="form-control" required>
                </div>
                <div class="col">
                    <label for="scheduled_time" class="fw-bold">Heure de publication:</label>
                    <input type="time" name="scheduled_time" id="scheduled_time" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="image" class="fw-bold">Image:</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*"
                    aria-label="Upload an image"> <!-- Champ pour télécharger l'image -->
            </div>
            <br>
            <button type="submit" class="btn btn-primary mt-4">Créer</button>
        </form>
    </div>
@endsection
