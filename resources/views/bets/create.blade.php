@extends('layouts.app')

@section('title', 'Create Bet')

@section('content')
    <a href="{{ route('bets.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">Bets</a>
    <h1 class="text-white text-2xl font-bold mb-6">Create a Bet</h1>

    <form action="{{ route('bets.store') }}" method="POST">
        @method('POST')
        @csrf
        <label class="flex flex-col text-white">
            User
            <select name="user_id" class="w-full p-2 text-white bg-black border border-white">
                <option value="">Select User</option>
                @foreach (\App\Models\User::orderBy('name')->get() as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </label>
        @error('user_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-white">
            Fixture
            <select name="fixture_id" class="w-full p-2 text-white bg-black border border-white">
                <option value="">Select Fixture</option>
                @foreach ($fixtures as $fixture)
                    <option value="{{ $fixture->id }}" {{ old('fixture_id') == $fixture->id ? 'selected' : '' }}>{{ $fixture->team1->long_name }} vs {{ $fixture->team2->long_name }} - {{ $fixture->started_at_local->format('Y-m-d H:i') }}</option>
                @endforeach
            </select>
        </label>
        @error('fixture_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-white">
            Winner Team (optional)
            <select name="winner_team_id" class="w-full p-2 text-white bg-black border border-white">
                <option value="">No winner (null)</option>
                @foreach ($teams as $team)
                    <option value="{{ $team->id }}" {{ old('winner_team_id') == $team->id ? 'selected' : '' }}>{{ $team->long_name }}</option>
                @endforeach
            </select>
        </label>
        @error('winner_team_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Create Bet</button>
    </form>
@endsection
