<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\User;

class FeedController extends Controller
{
    public function __invoke()
    {
        $user = request()->user();

        $dailyFixtures = Fixture::withCount('bets')
            ->with(['team1', 'team2', 'userBet'])
            ->orderByDesc('started_at')
            ->get()
            ->groupBy(fn ($fixture) => $fixture->started_at_local->toDateString());

        return view('feed', [
            'dailyFixtures' => $dailyFixtures,
            'user' => $user,
        ]);
    }
}
