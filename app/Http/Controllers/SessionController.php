<?php

namespace App\Http\Controllers;

use App\Models\OneTimeToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create(Request $request)
    {
        if ($request->user()) {
            return redirect()->route('profile.show');
        }

        $secret = $request->query('oneTimeToken');

        if ($secret) {
            // Verify the token exists
            $oneTimeToken = OneTimeToken::where('secret', $secret)->first();
            if (! $oneTimeToken) {
                return redirect('/')->with('error', 'Invalid or expired token');
            }

            return view('sessions.create', [
                'secret' => $secret,
                'userName' => $oneTimeToken->user->name,
            ]);
        }

        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->has('secret')
            ? $request->validate(['secret' => 'required|string'])
            : $request->validate(['name' => 'required|string', 'password' => 'required|string']);

        if ($request->has('secret')) {
            $oneTimeToken = OneTimeToken::where('secret', $validated['secret'])->first();

            if (! $oneTimeToken) {
                return redirect()->route('home')->with('error', 'Invalid or expired token');
            }

            $user = $oneTimeToken->user;
            Auth::login($user);
            $oneTimeToken->forceDelete();
        } elseif ($request->has(['name', 'password'])) {
            if (Auth::attempt($validated)) {
                $request->session()->regenerate();

                return redirect()->intended('home');
            }

            return back()->withErrors([
                'attempt' => 'No match found.',
            ])->onlyInput('name');
        }

        return redirect()->route('home');
    }
}
