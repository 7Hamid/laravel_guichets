@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une Catégorie</h1>

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

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom de la Catégorie:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mt-1">
            <button type="submit" class="btn btn-primary">Ajouter Catégorie</button>
            <br><br>
        </div>
    </form>
</div>
@endsection
