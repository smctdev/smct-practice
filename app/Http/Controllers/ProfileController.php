<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->update($request->validated());

        return redirect()
            ->route('profile.edit')
            ->with('status', 'All set — your profile has been updated.');
    }
}
