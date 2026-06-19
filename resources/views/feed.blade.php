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
                        <p class="text-gray-400 font-mono">{{ $fixture->started_at->format('M d') }}</p>
                        <div class="font-mono text-white">
                            <span class="{{ $fixture->team1->id == $fixture->winning_team_id ? 'border-b-4 border-b-lime-500' : ''}} {{ ($fixture->is_finished && is_null($fixture->winning_team_id)) ? 'border-b-4 border-b-white' : '' }}">{{ $fixture->team1->country_code }}</span>
                            -
                            <span class="{{ $fixture->team2->id == $fixture->winning_team_id ? 'border-b-4 border-b-lime-500' : ''}} {{ ($fixture->is_finished && is_null($fixture->winning_team_id)) ? 'border-b-4 border-b-white' : '' }}">{{ $fixture->team2->country_code }}</span>
                        </div>
                        @if ($fixture->userBet)
                            @if ($fixture->is_finished)
                                @if ($fixture->winning_team_id == $fixture->userBet->winner_team_id)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-lime-500" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                    </svg>
                                @endif
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                    <circle cx="8" cy="8" r="8"/>
                                </svg>
                            @endif
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500" width="16" height="16" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            </svg>
                        @endif
                        <p class="text-gray-400 font-mono">{{ $fixture->bets_count }}</p>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
