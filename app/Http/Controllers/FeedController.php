<?php

namespace App\Http\Controllers;

use App\Models\Fixture;

class FeedController extends Controller
{
    public function __invoke()
    {
        $user = request()->user();

        $fixtures = Fixture::withCount('bets')
            ->with(['team1', 'team2', 'userBet'])
            ->orderByDesc('started_at')
            ->get();

        return view('feed', [
            'fixtures' => $fixtures,
            'user' => $user,
        ]);
    }
}
