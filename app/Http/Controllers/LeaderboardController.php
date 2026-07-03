<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $leaderboard = User::withCount(['settledBets', 'wonBets'])
            ->withSum('settledBets', 'payout')
            ->orderByDesc('settled_bets_sum_payout')
            ->get();

        return view('leaderboard', [
            'leaderboard' => $leaderboard,
        ]);
    }
}
