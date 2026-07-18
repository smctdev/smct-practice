@extends('layouts.app')

@section('title', 'My profile')

@section('content')
    <h1>My profile</h1>

    <x-card title="Account details">
        <form method="POST" action="{{ route('profile.update') }}" class="stacked-form">
            @csrf
            @method('PATCH')

            <label for="name">Full name</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')<p class="field-error">{{ $message }}</p>@enderror

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')<p class="field-error">{{ $message }}</p>@enderror

            <label for="phone">Mobile number (optional)</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="09XX XXX XXXX">
            @error('phone')<p class="field-error">{{ $message }}</p>@enderror

            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
    </x-card>
@endsection
