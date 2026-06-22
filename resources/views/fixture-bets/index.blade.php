@extends('layouts.app')

@section('title', 'Bets')

@section('content')
    <a href="{{ route('feed') }}" class="block mt-2 mb-4 text-gray-500">Back</a>

    @if ($fixture->betting_is_closed)
        <div class="mb-4 flex justify-center items-center p-4 rounded bg-blue-900 text-white">
            Betting is closed
        </div>
    @endif

    <div class="p-4 flex justify-between items-center border border-white rounded">
        <div class="text-white">
            <div>
                <span class="font-mono {{ $fixture->team1->id == $fixture->winning_team_id ? 'border-b-4 border-b-lime-500' : ''}} {{ ($fixture->is_finished && is_null($fixture->winning_team_id)) ? 'border-b-4 border-b-white' : '' }}">{{ $fixture->team1->country_code }}</span>
                <span>- {{ $fixture->team1->long_name }}</span>
            </div>
            <div>
                <span class="font-mono {{ $fixture->team2->id == $fixture->winning_team_id ? 'border-b-4 border-b-lime-500' : ''}} {{ ($fixture->is_finished && is_null($fixture->winning_team_id)) ? 'border-b-4 border-b-white' : '' }}">{{ $fixture->team2->country_code }}</span>
                <span>- {{ $fixture->team2->long_name }}</span>
            </div>
            <div class="text-white">
                {{ $fixture->started_at_local->format('D M j g:i A') }}<br />
                {{ $fixture->started_at_local->diffForHumans() }}
            </div>
        </div>
    </div>

    @if ($fixture->bets->isEmpty())
        <div class="mt-4 border border-gray-600 rounded p-4 text-white">
            No bets
        </div>
    @else
        <div class="mt-4 border border-gray-500 rounded">
            @foreach ($fixture->bets as $bet)
                <div class="p-4 flex justify-between items-center border-b border-b-gray-500 last:border-b-0">
                    <p class="text-gray-400">{{ $bet->user->name }}</p>
                    <div class="flex items-center gap-2">
                        @if($bet->winnerTeam)
                            <span class="text-white font-mono">
                                {{ $bet->winnerTeam->country_code }}
                            </span>
                        @else
                            <span class="text-gray-400">Tie</span>
                        @endif
                    
                    <div>
                        @if ($fixture->is_finished)
                            @if ($fixture->winning_team_id == $bet->winner_team_id)
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
                    </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($user->is_admin)
        <div class="w-full mt-8">
            <a href="{{ route('fixtures.edit', $fixture) }}" class="block text-center w-full px-4 py-2 bg-blue-500 text-white rounded">
                Edit
            </a>
        </div>
    @endif
@endsection
        
