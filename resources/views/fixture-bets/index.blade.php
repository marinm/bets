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

    <div class="flex justify-between items-center">
        <div class="my-4 text-gray-500">
            {{ $fixture->started_at_local->format('D M j g:i A') }}
        </div>
         @if ($fixture->is_finished)
            <span class="text-gray-500">
                Finished
            </span>
        @elseif ($fixture->is_likely_in_progress)
            <span class="text-lime-500">
                <x-ping-dot />
                In progress
            </span>
        @else
            <span class="text-orange-500">
                Coming up
            </span>
        @endif
    </div>

    <div class="flex justify-center items-center gap-2">
        <div class="w-full p-4 flex flex-col justify-center items-center border-3 border-gray-900 rounded-xl text-white">
            <span class="font-mono text-lg">{{ $fixture->team1->country_code }}</span>
            <span>{{ $fixture->team1->long_name }}</span>
            @if ($fixture->is_finished)
                @if (is_null($fixture->winner_team_id))
                    <div class="mt-2 py-1 px-2 text-sm bg-gray-500 rounded">Draw</div>
                @else
                    @if ($fixture->winner_team_id == $fixture->team_1_id)
                        <div class="mt-2 py-1 px-2 text-sm bg-lime-500 rounded text-black">Won</div>
                    @else
                        <div class="mt-2 py-1 px-2 text-sm bg-gray-500 rounded">Lost</div>
                    @endif
                @endif
            @endif
        </div>
        <div class="w-full p-4 flex flex-col justify-center items-center border-3 border-gray-900 rounded-xl text-white">
            <span class="font-mono text-lg">{{ $fixture->team2->country_code }}</span>
            <span>{{ $fixture->team2->long_name }}</span>
            @if ($fixture->is_finished)
                @if (is_null($fixture->winner_team_id))
                    <div class="mt-2 py-1 px-2 text-sm bg-gray-500 rounded">Draw</div>
                @else
                    @if ($fixture->winner_team_id == $fixture->team_2_id)
                        <div class="mt-2 py-1 px-2 text-sm bg-lime-500 rounded">Won</div>
                    @else
                        <div class="mt-2 py-1 px-2 text-sm bg-gray-500 rounded">Lost</div>
                    @endif
                @endif
            @endif
        </div>
    </div>

    @if ($fixture->betting_is_closed)
        <div class="mt-4 flex justify-center items-center text-gray-500">
            Betting is closed
        </div>
    @endif

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
            <div class="mt-4 border border-gray-900 rounded-xl">    
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
            <div class="mt-4 border border-gray-900 rounded-xl">    
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
            <div class="mt-4 border border-gray-900 rounded-xl">    
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

    @if ($user->is_admin)
        @if ($fixture->settled_at_local)
            <div class="mt-4 flex justify-center items-center text-gray-500">
                Settled at {{ $fixture->settled_at_local->format('M d h:i A') }}
            </div>
        @endif
    @endif
@endsection
        
