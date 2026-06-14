<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|between:1,20|unique:users,name,'.$request->user()->id,
        ]);

        $request->user()->update($validated);

        return redirect()->route('profile.show');
    }
}
