@extends('layouts.app')

@section('title', 'Bets')

@section('content')
    <x-back-to-admin-menu />

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">Bets</h1>   
        <a href="{{ route('bets.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Create</a>
    </div>

    <div class="flex flex-col gap-4">
        @foreach ($bets as $bet)
            <a href="{{ route('bets.show', ['bet' => $bet]) }}" class="bg-gray-800 p-4 rounded flex justify-between items-center">
                <div class="flex-1">
                    <h2 class="text-white text-lg font-bold">{{ $bet->user->name }} - {{ $bet->fixture->team1->long_name }} vs {{ $bet->fixture->team2->long_name }}</h2>
                    <p class="text-gray-400">Prediction: {{ $bet->winnerTeam ? $bet->winnerTeam->long_name : 'Draw' }}</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection
