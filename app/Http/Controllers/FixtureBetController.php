<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Fixture;
use Illuminate\Http\Request;

class FixtureBetController extends Controller
{
    public function create(Fixture $fixture)
    {
        $fixture->load(['team1', 'team2']);

        $user = request()->user();
        $bet = Bet::with('winnerTeam')->firstWhere(['user_id' => $user->id, 'fixture_id' => $fixture->id]);

        return view('fixture-bets.create', [
            'fixture' => $fixture,
            'bet' => $bet,
        ]);
    }

    public function store(Request $request, Fixture $fixture)
    {
        $validated = $request->validate([
            'winner_team_id' => 'nullable|exists:teams,id',
        ]);

        $user = $request->user();

        Bet::create([
            'user_id' => $user->id,
            'fixture_id' => $fixture->id,
            'winner_team_id' => $validated['winner_team_id'],
        ]);

        return redirect()->route('feed');
    }
}
