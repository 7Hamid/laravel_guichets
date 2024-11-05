@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text">Login</h3>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger">Login</button>
                        </div>
                    </form>
                    <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                </div>
            </div>
            <br><br><br><br>
        </div>
    </div>
</div>
@endsection
