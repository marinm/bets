@extends('layouts.app')

@section('title', 'Bets')

@section('content')
    <div class="mb-2 flex justify-between items-center">
        <a href="{{ route('feed') }}" class="block mt-2 mb-4 text-gray-500">Back</a>

        @if ($user->is_admin)
            <div class="flex justify-end items-center gap-2">
                @if ($fixture->betting_is_closed && $fixture->is_finished)
                    <form action="{{ route('fixtures.settle', $fixture) }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded text-center py-2 px-4 bg-green-500">
                            @if (is_null($fixture->settled_at))
                                Settle
                            @else
                                Re-settle
                            @endif
                        </button>
                    </form>
                @endif

                <a href="{{ route('fixtures.edit', $fixture) }}" class="py-2 px-4 bg-blue-500 text-white rounded">
                    Edit
                </a>
            </div>
        @endif
    </div>

    

    @if ($fixture->betting_is_closed)
        <div class="mb-4 flex justify-center items-center p-4 rounded bg-blue-900 text-white">
            Betting is closed
        </div>
    @endif

    @if ($fixture->is_finished)
        <div class="mb-4 flex justify-center items-center p-4 rounded bg-green-800 text-white">
            Finished
        </div>
    @elseif ($fixture->is_likely_in_progress)
        <div class="mb-4 flex justify-center items-center p-4 rounded bg-green-800 text-white">
            In progress
        </div>
    @else
        <div class="mb-4 flex justify-center items-center p-4 rounded bg-orange-800 text-white">
            {{ $fixture->started_at_local->diffForHumans() }}
        </div>
    @endif

    @if ($user->is_admin)
        @if ($fixture->settled_at_local)
            <div class="mb-4 flex justify-center items-center p-4 rounded bg-green-800 text-white">
                Settled at {{ $fixture->settled_at_local->format('M d H:i A') }}
            </div>
        @endif
    @endif

    <div class="p-4 flex justify-between items-center border-3 border-gray-900 rounded-xl">
        <div class="text-white">
            <div>
                <span class="font-mono {{ $fixture->team1->id == $fixture->winner_team_id ? 'border-b-4 border-b-lime-500' : ''}} {{ ($fixture->is_finished && is_null($fixture->winner_team_id)) ? 'border-b-4 border-b-white' : '' }}">{{ $fixture->team1->country_code }}</span>
                <span>- {{ $fixture->team1->long_name }}</span>
            </div>
            <div>
                <span class="font-mono {{ $fixture->team2->id == $fixture->winner_team_id ? 'border-b-4 border-b-lime-500' : ''}} {{ ($fixture->is_finished && is_null($fixture->winner_team_id)) ? 'border-b-4 border-b-white' : '' }}">{{ $fixture->team2->country_code }}</span>
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
        @php
            $team1Bets = $fixture->bets->where('winner_team_id', $fixture->team_1_id);
            $drawBets = $fixture->bets->whereNull('winner_team_id');
            $team2Bets = $fixture->bets->where('winner_team_id', $fixture->team_2_id);
        @endphp
        @if ($team1Bets->isNotEmpty())
            <div class="mt-4 border border-gray-900 rounded-xl text-lg">    
                @foreach ($team1Bets as $bet)
                    <div class="p-4 flex justify-between items-center border-b border-b-gray-900 last:border-b-0">
                        <div class="flex items-center gap-2 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                            {{ $bet->user->name }}
                        </div>
                        <div class="flex justify-end items-center gap-2 text-white font-mono">
                            {{ $fixture->team1->country_code }}
                            <x-bet-status-icon :bet="$bet" />
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if ($drawBets->isNotEmpty())
            <div class="mt-4 border border-gray-900 rounded-xl text-lg">    
                @foreach ($drawBets as $bet)
                    <div class="p-4 flex justify-between items-center border-b border-b-gray-900 last:border-b-0">
                        <div class="flex items-center gap-2 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                            {{ $bet->user->name }}
                        </div>
                        <div class="flex justify-end items-center gap-2 text-white">
                            Draw
                            <x-bet-status-icon :bet="$bet" />
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if ($team2Bets->isNotEmpty())
            <div class="mt-4 border border-gray-900 rounded-xl text-lg">    
                @foreach ($team2Bets as $bet)
                    <div class="p-4 flex justify-between items-center border-b border-b-gray-900 last:border-b-0">
                        <div class="flex items-center gap-2 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                            {{ $bet->user->name }}
                        </div>
                        <div class="flex justify-end items-center gap-2 text-white font-mono">
                            {{ $fixture->team2->country_code }}
                            <x-bet-status-icon :bet="$bet" />
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
@endsection
        
