@extends('layouts.app')

@section('title', 'Bets')

@section('content')
    <a href="{{ route('feed') }}" class="block mt-2 mb-4 text-gray-500">Back</a>

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

    <div class="p-4 flex justify-between items-center border border-white rounded">
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
                            <span class="text-gray-400">Draw</span>
                        @endif
                    
                    <x-bet-result-icon :fixture="$fixture" :bet="$bet" />
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
        
