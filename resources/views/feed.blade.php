@extends('layouts.app')

@section('content')
    <div class="w-full py-4 flex justify-between items-center mb-4 text-amber-900">
        <a href="{{ route('leaderboard') }}" class="rounded ring-3 ring-amber-800 border-t border-t-orange-400 bg-orange-500 py-1 flex justify-center items-center gap-2 px-2 text-white font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            Leaderboard
        </a>
        <a href="{{ route('profile.show') }}" class="flex ring-3 ring-sky-900 border-t border-t-blue-300 bg-blue-400 rounded px-2 py-1 text-white font-bold">
            {{ $user->name }}
        </a>
    </div>

    <div class="mt-4 w-full flex flex-col justify-start items-center gap-4 font-bold">
        @foreach ($dailyFixtures as $fixtureGroup)
            <div class="w-full flex flex-col border-3 border-amber-300 ring-3 ring-amber-900 rounded-xl overflow-hidden bg-amber-50">
                @foreach ($fixtureGroup as $fixture)
                    @php
                        $url = $fixture->userBet
                            ? route('fixture-bets.index', $fixture)
                            : route('fixture-bets.create', $fixture)
                    @endphp
                    <a href="{{ $url }}" class="p-4 flex justify-between items-center border-b border-amber-300 last:border-b-0">
                        <div class="flex justify-between items-center gap-6">
                            <div class="text-amber-900 font-mono flex items-center">
                                {{ $fixture->started_at_local->format('M d') }}
                            </div>
                            <div class="size-3">
                                @if ($fixture->is_likely_in_progress)
                                    <x-ping-dot />
                                @endif
                            </div>
                            <div class="font-mono text-amber-900">
                                <span class="{{ $fixture->team1->id == $fixture->winner_team_id ? 'border-b-4 border-b-lime-400' : ''}} {{ ($fixture->is_finished && is_null($fixture->winner_team_id)) ? 'border-b-4 border-b-white' : '' }}">{{ $fixture->team1->country_code }}</span>
                                -
                                <span class="{{ $fixture->team2->id == $fixture->winner_team_id ? 'border-b-4 border-b-lime-400' : ''}} {{ ($fixture->is_finished && is_null($fixture->winner_team_id)) ? 'border-b-4 border-b-white' : '' }}">{{ $fixture->team2->country_code }}</span>
                            </div>
                        </div>
                        <p class="text-amber-900 font-mono">{{ $fixture->bets_count }}</p>
                        <x-bet-status-icon :bet="$fixture->userBet" />
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
