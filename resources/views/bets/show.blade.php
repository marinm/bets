@extends('layouts.app')

@section('title', 'Bet')

@section('content')
    <a href="{{ route('bets.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">Bets</a>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">Bet</h1>
        <a href="{{ route('bets.edit', ['bet' => $bet]) }}" class="px-4 py-2 bg-blue-500 text-white rounded">Edit</a>
    </div>

    <div class="bg-gray-800 p-4 rounded">
        <p class="text-gray-400">User: {{ $bet->user->name }}</p>
        <p class="text-gray-400">Fixture: {{ $bet->fixture->team1->long_name }} vs {{ $bet->fixture->team2->long_name }}</p>
        <p class="text-gray-400">Fixture Date: {{ $bet->fixture->started_at->format('Y-m-d H:i') }}</p>
        <p class="text-gray-400">Winner Team: {{ $bet->winnerTeam ? $bet->winnerTeam->long_name : 'No winner' }}</p>
        <p class="text-gray-400">Created: {{ $bet->created_at->format('Y-m-d H:i') }}</p>
    </div>

    <form action="{{ route('bets.destroy', ['bet' => $bet]) }}" method="POST" class="mt-4">
        @method('DELETE')
        @csrf
        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded">Delete</button>
    </form>
@endsection
