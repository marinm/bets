@extends('layouts.app')

@section('title', 'Fixture')

@section('content')
    <a href="{{ route('fixtures.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">Fixtures</a>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">Fixture</h1>
        <a href="{{ route('fixtures.edit', ['fixture' => $fixture]) }}" class="px-4 py-2 bg-blue-500 text-white rounded">Edit</a>
    </div>

    <div class="bg-gray-800 p-4 rounded">
        <p class="text-gray-400">Team 1: {{ $fixture->team1->long_name }}</p>
        <p class="text-gray-400">Team 2: {{ $fixture->team2->long_name }}</p>
        <p class="text-gray-400">Started at: {{ $fixture->started_at_local->format('Y-m-d H:i') }}</p>
        <p class="text-gray-400">Bets closed at: {{ $fixture->bets_closed_at->format('Y-m-d H:i') }}</p>
        <p class="text-gray-400">Is Finished: {{ $fixture->is_finished ? 'Yes' : 'No' }}</p>
        <p class="text-gray-400">Winning Team: {{ $fixture->winningTeam ? $fixture->winningTeam->long_name : 'N/A' }}</p>
    </div>

    <form action="{{ route('fixtures.destroy', ['fixture' => $fixture]) }}" method="POST" class="mt-4">
        @method('DELETE')
        @csrf
        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded">Delete</button>
    </form>
@endsection
