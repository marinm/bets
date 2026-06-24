@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <div class="w-full py-4 flex justify-end items-center mb-4 text-white">
        <a href="{{ route('profile.show') }}" class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
        </a>
    </div>
    <div class="w-full flex flex-col justify-start items-center gap-4">
        @foreach ($dailyFixtures as $fixtureGroup)
            <div class="w-full flex flex-col border border-gray-800 bg-gray-900 rounded-lg overflow-hidden">
                @foreach ($fixtureGroup as $fixture)
                    @php
                        $url = $fixture->userBet
                            ? route('fixture-bets.index', $fixture)
                            : route('fixture-bets.create', $fixture)
                    @endphp
                    <a href="{{ $url }}" class="p-4 flex justify-between items-center border-b border-gray-800 first:border-t">
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
                        <x-bet-result-icon :fixture="$fixture" :bet="$fixture->userBet" />
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
