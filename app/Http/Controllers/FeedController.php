<?php

namespace App\Http\Controllers;

use App\Models\Fixture;

class FeedController extends Controller
{
    public function __invoke()
    {
        $fixtures = Fixture::with(['team1', 'team2', 'bets' => function ($query) {
            $query->where('user_id', request()->user()->id);
        }])->orderBy('started_at')->get();

        return view('feed', [
            'fixtures' => $fixtures,
        ]);
    }
}
