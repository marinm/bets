<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Http\Request;

class BetController extends Controller
{
    public function index()
    {
        $bets = Bet::with(['user', 'fixture', 'winnerTeam'])->orderBy('created_at', 'desc')->get();

        return view('bets.index', [
            'bets' => $bets,
        ]);
    }

    public function create()
    {
        return view('bets.create', [
            'fixtures' => Fixture::orderBy('started_at')->get(),
            'teams' => Team::orderBy('long_name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'fixture_id' => 'required|exists:fixtures,id',
            'winner_team_id' => 'nullable|exists:teams,id',
            'amount_cents' => 'required|integer|min:1',
        ]);

        Bet::create($validated);

        return redirect()->route('bets.index');
    }

    public function show(Bet $bet)
    {
        $bet->load(['user', 'fixture', 'winnerTeam']);

        return view('bets.show', ['bet' => $bet]);
    }

    public function edit(Bet $bet)
    {
        $bet->load(['user', 'fixture', 'winnerTeam']);

        return view('bets.edit', [
            'bet' => $bet,
            'fixtures' => Fixture::orderBy('started_at')->get(),
            'teams' => Team::orderBy('long_name')->get(),
        ]);
    }

    public function update(Request $request, Bet $bet)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'fixture_id' => 'required|exists:fixtures,id',
            'winner_team_id' => 'nullable|exists:teams,id',
            'amount_cents' => 'required|integer|min:1',
        ]);

        $bet->update($validated);

        return redirect()->route('bets.show', ['bet' => $bet]);
    }

    public function destroy(Bet $bet)
    {
        $bet->delete();

        return redirect()->route('bets.index');
    }
}
