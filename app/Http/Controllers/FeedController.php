<?php

namespace App\Http\Controllers;

use App\Models\Fixture;

class FeedController extends Controller
{
    public function __invoke()
    {
        $user = request()->user();

        $fixtures = Fixture::withCount('bets')
            ->with(['team1', 'team2', 'bets' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->orderBy('started_at')
            ->get();

        $user->loadCount('bets');

        return view('feed', [
            'fixtures' => $fixtures,
            'user' => $user,
        ]);
    }
}
