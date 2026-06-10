<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'internal_name' => 'required|string|max:255|unique:users,internal_name',
            'balance_cents' => 'required|integer|min:0',
        ]);

        User::create($validated);

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,'.$user->id,
            'internal_name' => 'required|string|max:255|unique:users,internal_name,'.$user->id,
            'balance_cents' => 'required|integer|min:0',
        ]);

        $user->update($validated);

        return redirect()->route('users.show', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        if ($user->bets()->count() > 0) {
            return redirect()->route('users.index')->withErrors(['error' => 'Cannot delete user with existing bets.']);
        }

        if ($user->is_admin) {
            return redirect()->route('users.index')->withErrors(['error' => 'Cannot delete admin user.']);
        }

        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->withErrors(['error' => 'Cannot delete currently authenticated user.']);
        }

        $user->delete();

        return redirect()->route('users.index');
    }
}
