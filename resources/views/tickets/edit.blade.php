@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ isset($ticket) ? 'Modifier le Ticket' : 'Ajouter un Ticket' }}</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Il y a eu des problèmes avec votre saisie.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('tickets._form') <!-- This includes the form fields -->
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
@endsection
