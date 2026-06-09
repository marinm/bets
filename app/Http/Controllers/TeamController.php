<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        return view('teams.index', [
            'teams' => Team::orderBy('long_name')->get(),
        ]);
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_code' => 'required|string|size:2|unique:teams,country_code',
            'long_name' => 'required|string|max:255',
        ]);

        Team::create($validated);

        return redirect()->route('teams.index');
    }

    public function show(Team $team)
    {
        return view('teams.show', ['team' => $team]);
    }

    public function edit(Team $team)
    {
        return view('teams.edit', ['team' => $team]);
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'country_code' => 'required|string|size:2|unique:teams,country_code,'.$team->id,
            'long_name' => 'required|string|max:255',
        ]);

        $team->update($validated);

        return redirect()->route('teams.show', ['team' => $team]);
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index');
    }
}
