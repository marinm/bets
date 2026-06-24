<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FixtureController extends Controller
{
    public function index()
    {
        $fixtures = Fixture::with(['team1', 'team2', 'winningTeam'])
            ->orderByDesc('started_at')
            ->get();

        return view('fixtures.index', [
            'fixtures' => $fixtures,
        ]);
    }

    public function create()
    {
        return view('fixtures.create', [
            'teams' => Team::orderBy('long_name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'started_at' => 'required|date',
            'team_1_id' => 'required|exists:teams,id|different:team_2_id',
            'team_2_id' => 'required|exists:teams,id|different:team_1_id',
            'is_finished' => 'boolean',
            'winner_team_id' => 'nullable|exists:teams,id',
        ]);

        $timezone = $request->user()->timezone ?? 'America/Toronto';
        $validated['started_at'] = Carbon::parse($validated['started_at'], $timezone)->utc()->toDateTimeString();

        Fixture::create($validated);

        return redirect()->route('fixtures.index');
    }

    public function show(Fixture $fixture)
    {
        $fixture->load(['team1', 'team2', 'winningTeam']);

        return view('fixtures.show', ['fixture' => $fixture]);
    }

    public function edit(Fixture $fixture)
    {
        $fixture->load(['team1', 'team2', 'winningTeam']);

        return view('fixtures.edit', [
            'fixture' => $fixture,
        ]);
    }

    public function update(Request $request, Fixture $fixture)
    {
        $validated = $request->validate([
            'started_at' => 'required|date',
            'is_finished' => 'boolean',
            'winner_team_id' => 'nullable|exists:teams,id',
        ]);

        $timezone = $request->user()->timezone ?? 'America/Toronto';
        $validated['started_at'] = Carbon::parse($validated['started_at'], $timezone)->utc()->toDateTimeString();

        $fixture->update($validated);

        return redirect()->route('fixtures.show', ['fixture' => $fixture]);
    }

    public function destroy(Fixture $fixture)
    {
        $fixture->delete();

        return redirect()->route('fixtures.index');
    }
}
