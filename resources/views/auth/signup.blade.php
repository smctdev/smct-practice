@extends('layouts.app')

@section('title', 'Sign up')

@section('content')
    {{-- planted for S1: the off-system form — copied in from an old internal
         tool; ignores the app's .card component and the tokens in app.css. --}}
    <style>
        #regbox {
            width: 420px;
            margin: 30px auto;
            background: #EFEFEF;
            border: 2px solid #7A7A7A;
            padding: 18px;
            font-family: Verdana, Arial, sans-serif;
            font-size: 12px;
        }
        #regbox h2 {
            background: #2E5C8A;
            color: #FFFFFF;
            margin: -18px -18px 14px -18px;
            padding: 8px 18px;
            font-size: 14px;
            text-transform: uppercase;
        }
        #regbox label { display: block; font-weight: bold; margin-top: 10px; }
        #regbox input {
            width: 96%;
            border: 1px solid #7A7A7A;
            padding: 4px;
            background: #FFFFFF;
            font-size: 12px;
        }
        #regbox .err { color: #CC0000; font-weight: bold; }
        #regbox .submitbtn {
            margin-top: 14px;
            width: auto;
            background: #C0C0C0;
            border: 2px outset #FFFFFF;
            padding: 4px 18px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>

    <div id="regbox">
        <h2>New User Registration</h2>

        <form method="POST" action="{{ route('signup') }}">
            @csrf

            <label for="reg-name">ENTER NAME:</label>
            <input id="reg-name" type="text" name="name" value="{{ old('name') }}">
            @error('name')<span class="err">{{ $message }}</span>@enderror

            <label for="reg-email">ENTER EMAIL:</label>
            <input id="reg-email" type="text" name="email" value="{{ old('email') }}">
            @error('email')<span class="err">{{ $message }}</span>@enderror

            <label for="reg-password">ENTER PASSWORD:</label>
            <input id="reg-password" type="password" name="password">
            @error('password')<span class="err">{{ $message }}</span>@enderror

            <label for="reg-password-confirm">RE-ENTER PASSWORD:</label>
            <input id="reg-password-confirm" type="password" name="password_confirmation">

            <button type="submit" class="submitbtn">SUBMIT</button>
        </form>
    </div>
@endsection
