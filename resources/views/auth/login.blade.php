@extends('layouts.app')

@section('title', 'Log in')

@section('content')
    <div class="narrow">
        <x-card title="Log in">
            <form method="POST" action="{{ route('login') }}" class="stacked-form">
                @csrf

                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')<p class="field-error">{{ $message }}</p>@enderror

                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')<p class="field-error">{{ $message }}</p>@enderror

                <button type="submit" class="btn btn-primary">Log in</button>
            </form>

            <p class="muted">No account yet? <a href="{{ route('signup') }}">Sign up here.</a></p>
        </x-card>
    </div>
@endsection
