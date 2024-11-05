@extends('layouts.app') <!-- Assuming your main layout file is named app.blade.php -->

@section('title', 'Profile') <!-- Title for the profile page -->

@section('content')
<div class="container mt-5">
    <H1>Mes informations</H1>
    <P>Name  : {{ Auth::user()->name }}</P>
    <p>Email : {{ Auth::user()->email }}</p>

    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    <br><br><br><br><br>
</div>
@endsection
