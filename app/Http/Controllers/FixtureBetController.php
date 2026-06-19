<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Fixture;
use Illuminate\Http\Request;

class FixtureBetController extends Controller
{
    public function index(Request $request, Fixture $fixture)
    {
        $user = $request->user();

        $bet = $fixture->bets->firstWhere('user_id', $user->id);

        if (! $bet) {
            return redirect()->route('fixture-bets.create', $fixture);
        }

        $fixture->load(['team1', 'team2', 'bets.winnerTeam']);

        return view('fixture-bets.index', [
            'bet' => $bet,
            'fixture' => $fixture,
        ]);
    }

    public function create(Request $request, Fixture $fixture)
    {
        $fixture->load(['team1', 'team2']);

        $user = $request->user();
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

        if ($user->bets()->where('fixture_id', $fixture->fixture_id)->exists()) {
            abort(400, "You cannot bet on the same fixture twice.");
        }

        Bet::create([
            'user_id' => $user->id,
            'fixture_id' => $fixture->id,
            'winner_team_id' => $validated['winner_team_id'],
        ]);

        return redirect()->route('fixture-bets.index', $fixture);
    }
}
