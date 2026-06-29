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

        $userBet = $fixture->bets->firstWhere('user_id', $user->id);

        if (! $userBet && ! $fixture->betting_is_closed) {
            return redirect()->route('fixture-bets.create', $fixture);
        }

        $fixture->load(['team1', 'team2', 'bets.winnerTeam'])->loadCount('bets');

        return view('fixture-bets.index', [
            'bet' => $userBet,
            'fixture' => $fixture,
            'user' => $user,
        ]);
    }

    public function create(Request $request, Fixture $fixture)
    {
        if ($fixture->betting_is_closed) {
            return redirect()->route('fixture-bets.index', $fixture);
        }

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
        $user = $request->user();

        if ($fixture->betting_is_closed) {
            abort(400, 'Betting is closed for this fixture.');
        }

        if ($user->bets()->where('fixture_id', $fixture->fixture_id)->exists()) {
            abort(400, 'You cannot bet on the same fixture twice.');
        }

        $validated = $request->validate([
            'winner_team_id' => [
                'present',
                $fixture->can_draw ? 'nullable' : 'required',
                'exists:teams,id',
            ],
        ]);

        Bet::create([
            'user_id' => $user->id,
            'fixture_id' => $fixture->id,
            'winner_team_id' => $validated['winner_team_id'],
        ]);

        return redirect()->route('fixture-bets.index', $fixture);
    }
}
