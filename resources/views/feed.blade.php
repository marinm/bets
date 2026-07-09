@extends('layouts.app')

@section('content')
    <div class="w-full py-4 flex justify-between items-center mb-4 text-white">
        <a href="{{ route('leaderboard') }}" class="flex justify-center items-center gap-2 bg-rose-500 px-2 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
            Leaderboard
        </a>
        <a href="{{ route('profile.show') }}" class="flex justify-center items-center gap-2 bg-indigo-500 px-2 rounded">
            {{ $user->name }}
        </a>
    </div>

    <div class="mt-4 w-full flex flex-col justify-start items-center gap-4">
        @foreach ($dailyFixtures as $fixtureGroup)
            <div class="w-full flex flex-col border border-gray-800 bg-gray-900 rounded-lg overflow-hidden">
                @foreach ($fixtureGroup as $fixture)
                    @php
                        $url = $fixture->userBet
                            ? route('fixture-bets.index', $fixture)
                            : route('fixture-bets.create', $fixture)
                    @endphp
                    <a href="{{ $url }}" class="p-4 flex justify-between items-center border-b border-gray-800 last:border-b-0">
                        <div class="flex justify-between items-center gap-6">
                            <div class="text-gray-400 font-mono flex items-center">
                                {{ $fixture->started_at_local->format('M d') }}
                            </div>
                            <div class="size-3">
                                @if ($fixture->is_likely_in_progress)
                                    <x-ping-dot />
                                @endif
                            </div>
                            <div class="font-mono text-white">
                                <span class="{{ $fixture->team1->id == $fixture->winner_team_id ? 'border-b-4 border-b-lime-500' : ''}} {{ ($fixture->is_finished && is_null($fixture->winner_team_id)) ? 'border-b-4 border-b-white' : '' }}">{{ $fixture->team1->country_code }}</span>
                                -
                                <span class="{{ $fixture->team2->id == $fixture->winner_team_id ? 'border-b-4 border-b-lime-500' : ''}} {{ ($fixture->is_finished && is_null($fixture->winner_team_id)) ? 'border-b-4 border-b-white' : '' }}">{{ $fixture->team2->country_code }}</span>
                            </div>
                        </div>
                        <p class="text-gray-400 font-mono">{{ $fixture->bets_count }}</p>
                        <x-bet-status-icon :bet="$fixture->userBet" />
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
