@extends('layouts.app')

@section('title', 'Create Bet')

@section('content')
    <a href="{{ route('feed') }}" class="block mt-2 text-gray-400">Back</a>

    <div class="bg-gray-800 p-4 mt-10 mb-4 rounded border border-white">
        <div class="flex items-center justify-start gap-1">
            <p class="text-white text-lg font-bold truncate">{{ $fixture->team1->long_name }}</p>
        </div>
        <div class="flex items-center justify-start gap-1">
            <p class="text-white text-lg font-bold truncate">{{ $fixture->team2->long_name }}</p>
        </div>
        <p class="text-gray-400 mt-4">{{ $fixture->started_at_local->format('D, M j h:i A') }}</p>
    </div>

    <form action="{{ route('fixture-bets.store', ['fixture' => $fixture]) }}" method="POST">
        @method('POST')
        @csrf
        <div class="border border-white rounded">
            <label class="flex justify-between items-center text-white p-4 border-b border-white">
                <div>
                    <input type="radio" name="winner_team_id" value="{{ $fixture->team1->id }}" {{ old('winner_team_id') == $fixture->team1->id ? 'checked' : '' }} class="mr-2" />
                    {{ $fixture->team1->long_name }}
                </div>
                <div class="font-mono text-white-800">
                    {{ $fixture->team1->country_code }}
                </div>
            </label>
            <label class="flex justify-between items-center text-white p-4 border-b border-white">
                <div>
                    <input type="radio" name="winner_team_id" value="{{ $fixture->team2->id }}" {{ old('winner_team_id') == $fixture->team2->id ? 'checked' : '' }} class="mr-2" />
                    {{ $fixture->team2->long_name }}
                </div>
                <div class="font-mono text-white-800">
                    {{ $fixture->team2->country_code }}
                </div>
            </label>
            <label class="flex items-center text-white p-4">
                <input type="radio" name="winner_team_id" value="" {{ old('winner_team_id', null) === '' ? 'checked' : '' }} class="mr-2" />
                Draw/Tie
            </label>
        </div>
        @error('winner_team_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <div class="flex justify-center items-center">
            <button type="submit" class="mx-auto mt-12 px-12 py-4 bg-blue-500 text-white rounded-full">Bet</button>
        </div>
    </form>
@endsection
