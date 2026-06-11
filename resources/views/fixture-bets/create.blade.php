@extends('layouts.app')

@section('title', 'Create Bet')

@section('content')
    <a href="{{ route('fixtures.show', ['fixture' => $fixture]) }}" class="text-gray-400 hover:text-white mb-4 inline-block">Fixture</a>
    <h1 class="text-white text-2xl font-bold mb-6">Create a Bet on {{ $fixture->team1->long_name }} vs {{ $fixture->team2->long_name }}</h1>

    <form action="{{ route('fixture-bets.store', ['fixture' => $fixture]) }}" method="POST">
        @method('POST')
        @csrf
        <fieldset class="border border-white p-4 rounded mb-4">
            <legend class="text-white px-2">Winner</legend>
            
            <label class="flex items-center text-white mb-3">
                <input type="radio" name="winner_team_id" value="{{ $fixture->team1->id }}" {{ old('winner_team_id') == $fixture->team1->id ? 'checked' : '' }} class="mr-2" />
                {{ $fixture->team1->long_name }}
            </label>

            <label class="flex items-center text-white mb-3">
                <input type="radio" name="winner_team_id" value="{{ $fixture->team2->id }}" {{ old('winner_team_id') == $fixture->team2->id ? 'checked' : '' }} class="mr-2" />
                {{ $fixture->team2->long_name }}
            </label>

            <label class="flex items-center text-white">
                <input type="radio" name="winner_team_id" value="" {{ old('winner_team_id') == '' ? 'checked' : '' }} class="mr-2" />
                Draw/Tie
            </label>
        </fieldset>
        @error('winner_team_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <p class="text-gray-400 text-sm mt-1">Bets are final.</p>

        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Create Bet</button>
    </form>
@endsection
