<?php

namespace App\Http\Controllers;

use App\Models\OneTimeToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OneTimeTokenController extends Controller
{
    public function index()
    {
        $oneTimeTokens = OneTimeToken::with('user')->orderBy('created_at', 'desc')->get();

        return view('one-time-tokens.index', [
            'oneTimeTokens' => $oneTimeTokens,
        ]);
    }

    public function create()
    {
        return view('one-time-tokens.create', [
            'users' => User::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $secret = Str::random(16);
        OneTimeToken::create([
            'secret' => $secret,
            'user_id' => $validated['user_id'],
        ]);

        return redirect()->route('one-time-tokens.index');
    }

    public function show(OneTimeToken $oneTimeToken)
    {
        $oneTimeToken->load('user');

        return view('one-time-tokens.show', [
            'oneTimeToken' => $oneTimeToken,
            'url' => route('sessions.create', ['oneTimeToken' => $oneTimeToken->secret]),
        ]);
    }

    public function destroy(OneTimeToken $oneTimeToken)
    {
        $oneTimeToken->delete();

        return redirect()->route('one-time-tokens.index');
    }
}
