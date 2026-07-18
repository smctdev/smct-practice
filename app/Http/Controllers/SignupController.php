<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    public function create()
    {
        return view('auth.signup');
    }

    public function store(Request $request)
    {
        // planted for S1: the off-system form — the messages below are robotic,
        // and the signup view ignores the app's card component and tokens.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Invalid input.',
            'email.required' => 'Invalid input.',
            'email.email' => 'Invalid input.',
            'email.unique' => 'ERROR: DUPLICATE ENTRY.',
            'password.required' => 'Invalid input.',
            'password.min' => 'Password error.',
            'password.confirmed' => 'Password error.',
        ]);

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('profile.edit');
    }
}
