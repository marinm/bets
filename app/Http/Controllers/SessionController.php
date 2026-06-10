<?php

namespace App\Http\Controllers;

use App\Models\OneTimeToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create(Request $request)
    {
        $secret = $request->query('oneTimeToken');

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'secret' => 'required|string',
        ]);

        $oneTimeToken = OneTimeToken::where('secret', $validated['secret'])->first();

        if (! $oneTimeToken) {
            return redirect('/')->with('error', 'Invalid or expired token');
        }

        $user = $oneTimeToken->user;
        Auth::login($user);
        $oneTimeToken->forceDelete();

        return redirect('/');
    }
}
