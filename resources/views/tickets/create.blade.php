@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

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

                <form action="{{ isset($ticket) ? route('tickets.update', $ticket->id) : route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($ticket))
                        @method('PUT')
                    @endif

                    @include('tickets._form')

                    <button type="submit" class="btn btn-primary mb-5">
                        {{ isset($ticket) ? 'Mettre à jour' : 'Créer' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.replace('description');
        });
    </script>
@endsection
