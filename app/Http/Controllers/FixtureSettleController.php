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

        foreach ($fixture->bets as $bet) {
            $status = ($fixture->winner_team_id === $bet->winner_team_id)
                ? BetStatus::Won
                : BetStatus::Lost;

            $bet->update(['status' => $status]);
        }

        $fixture->update(['settled_at' => now()]);

        info($fixture->settled_at);

        return redirect()->route('fixture-bets.index', $fixture);
    }
}
