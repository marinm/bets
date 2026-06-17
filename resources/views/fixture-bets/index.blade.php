@extends('layouts.app')

@section('title', 'Create Bet')

@section('content')
    <a href="{{ route('feed') }}" class="block mt-2 mb-2 text-gray-400">Back</a>
    <h2 class="text-white text-lg font-bold truncate mt-8 mb-2">All bets</h2>

    @isset($bet)
        <div class="bg-gray-800 p-4 mb-4 rounded">
            <p class="text-gray-400">Your Bet: {{ $bet->winnerTeam ? $bet->winnerTeam->long_name : 'No winner' }}</p>
        </div>
    @endisset

    @foreach ($fixture->bets as $bet)
        <div class="bg-gray-800 p-4 mb-2 rounded flex justify-between items-center">
            <p class="text-gray-400">{{ $bet->user->name }}</p>
            <div class="flex items-center gap-2">
                @if($bet->winnerTeam)
                    <span class="text-white">
                        {{ $bet->winnerTeam->country_code }}
                    </span>
                    <span class="fi fi-{{ strtolower($bet->winnerTeam->country_code) }}"></span>
                @else
                    <span class="text-gray-400">Tie</span>
                @endif
            </div>
        </div>
    @endforeach
@endsection
        
