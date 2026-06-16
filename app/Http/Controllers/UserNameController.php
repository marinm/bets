<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNameController extends Controller
{
    public function edit(Request $request)
    {
        return view('users.name.edit', [
            'user' => $request->user(),
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,'.$user->id,
        ]);

        $request->user()->update($validated);

        return redirect()->route('profile.show');
    }
}
