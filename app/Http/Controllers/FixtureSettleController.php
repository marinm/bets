<?php

namespace App\Http\Controllers;

use App\Enums\BetStatus;
use App\Models\Fixture;

class FixtureSettleController extends Controller
{
    public function __invoke(Fixture $fixture)
    {
        if (! $fixture->betting_is_closed) {
            abort(400, 'Fixture betting is not closed.');
        }

        if (! $fixture->is_finished) {
            abort(400, 'Fixture is not finished.');
        }

        $totalBetsCount = $fixture->bets()->count();

        $wonBetsCount = $fixture->bets()
            ->where('winner_team_id', '<=>', $fixture->winner_team_id)
            ->count();

        $lostBetsCount = $totalBetsCount - $wonBetsCount;

        $payoutPool = $lostBetsCount * 100;

        $payoutPerBet = ($wonBetsCount > 0)
            ? round($payoutPool / $wonBetsCount)
            : 0;

        info($payoutPerBet);

        foreach ($fixture->bets as $bet) {
            if ($fixture->winner_team_id === $bet->winner_team_id) {
                info("User {$bet->user->name} won {$payoutPerBet}");
                $bet->update([
                    'payout' => $payoutPerBet,
                    'status' => BetStatus::Won,
                ]);
            } else {
                $bet->update([
                    'payout' => -100,
                    'status' => BetStatus::Lost,
                ]);
            }
        }

        $fixture->update(['settled_at' => now()]);

        return redirect()->route('fixture-bets.index', $fixture);
    }
}
