<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
               <div class="dropdown">
                    <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ajouter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('tickets.create') }}" class="dropdown-item">Ticket</a></li>
                        <li><a href="{{ route('categories.create') }}" class="dropdown-item">Catégorie</a></li>
                        <li><a href="{{ route('programmableTickets.create') }}" class="dropdown-item">Programmable Ticket</a></li>


                    </ul>
                </div>
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Adresse</th>
                            <th>Localisation</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Prix VIP</th>
                            <th>Phone</th>
                            <th>Devise</th>
                            <th width="280px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $ticket)
                            <tr class="text-center">
                                <td>
                                    @if ($ticket->image)
                                        <img src="{{ asset('storage/' . $ticket->image) }}" alt="Image du Ticket {{ $ticket->title }}" style="width: 50px; height: auto;">
                                    @else
                                        <span>Aucune image</span>
                                    @endif
                                </td>
                                <td>{{ $ticket->title }}</td>
                                <td>{{ Str::limit($ticket->description, 10) }}</td>
                                <td>{{ $ticket->adresse }}</td>
                                <td>{{ Str::limit($ticket->localisation, 10) }}</td>
                                <td>{{ $ticket->categorie }}</td>
                                <td>{{ number_format($ticket->prix, 2, ',', ' ') }}</td>
                                <td>{{ number_format($ticket->prix_vip, 2, ',', ' ') }}</td>
                                <td>{{ $ticket->phone }}</td>
                                <td>{{$ticket->devise}}</td>
                                <td>
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                                        <a class="btn btn-info" href="{{ route('tickets.show', $ticket->id) }}"><i class="fa-solid fa-eye"></i></a>
                                        <a class="btn btn-primary" href="{{ route('tickets.edit', $ticket->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun ticket disponible.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
