@extends('layouts.app')

@section('title', 'Create Bet')

@section('content')
    <a href="{{ route('feed') }}" class="block mt-2 text-gray-400">Back</a>

    <div class="bg-gray-800 p-4 mt-10 mb-4 rounded flex justify-between items-center">
        <div class="flex-1">
            <p class="text-white text-lg font-bold truncate">{{ $fixture->team1->long_name }}</p>
            <p class="text-white text-lg font-bold truncate">{{ $fixture->team2->long_name }}</p>
            <p class="text-gray-400">{{ $fixture->started_at->format('Y-m-d H:i') }}</p>
        </div>
        <p class="text-gray-400">{{ $fixture->is_finished ? 'Finished' : 'Upcoming' }}</p>
    </div>

    @if ($bet)
        <div class="bg-gray-800 p-4 mb-4 rounded">
            <p class="text-gray-400">Your Bet: {{ $bet->winnerTeam ? $bet->winnerTeam->long_name : 'No winner' }}</p>
        </div>
    @else
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

            <div class="flex justify-center items-center">
                <button type="submit" class="mx-auto mt-4 px-12 py-4 bg-blue-500 text-white rounded-full">Bet</button>
            </div>
        </form>
    @endif

    <h2 class="text-white text-lg font-bold truncate mt-8 mb-2">All bets</h2>

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
    </div>
@endsection
