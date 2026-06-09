@extends('layouts.app')

@section('title', 'Edit Fixture')

@section('content')
    <a href="{{ route('fixtures.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">Fixtures</a>
    <h1 class="text-white text-2xl font-bold mb-6">Edit Fixture</h1>

    <form action="{{ route('fixtures.update', ['fixture' => $fixture]) }}" method="POST">
        @method('PUT')
        @csrf
        <label class="flex flex-col text-white">
            Team 1
            <select name="team_1_id" class="w-full p-2 text-white bg-black border border-white">
                <option value="">Select Team 1</option>
                @foreach ($teams as $team)
                    <option value="{{ $team->id }}" {{ old('team_1_id', $fixture->team_1_id) == $team->id ? 'selected' : '' }}>{{ $team->long_name }}</option>
                @endforeach
            </select>
        </label>
        @error('team_1_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-white">
            Team 2
            <select name="team_2_id" class="w-full p-2 text-white bg-black border border-white">
                <option value="">Select Team 2</option>
                @foreach ($teams as $team)
                    <option value="{{ $team->id }}" {{ old('team_2_id', $fixture->team_2_id) == $team->id ? 'selected' : '' }}>{{ $team->long_name }}</option>
                @endforeach
            </select>
        </label>
        @error('team_2_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-white">
            Started at
            <input type="datetime-local" name="started_at" value="{{ old('started_at', $fixture->started_at->format('Y-m-d\TH:i')) }}" class="w-full p-2 text-white bg-black border border-white" />
        </label>
        @error('started_at')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-white">
            Bets closed at
            <input type="datetime-local" name="bets_closed_at" value="{{ old('bets_closed_at', $fixture->bets_closed_at->format('Y-m-d\TH:i')) }}" class="w-full p-2 text-white bg-black border border-white" />
        </label>
        @error('bets_closed_at')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex items-center text-white">
            <input type="checkbox" name="is_finished" value="1" {{ old('is_finished', $fixture->is_finished) ? 'checked' : '' }} class="mr-2" />
            Is Finished
        </label>
        @error('is_finished')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <label class="flex flex-col text-white">
            Winning Team
            <select name="winning_team_id" class="w-full p-2 text-white bg-black border border-white">
                <option value="">Select Winning Team (optional)</option>
                @foreach ($teams as $team)
                    <option value="{{ $team->id }}" {{ old('winning_team_id', $fixture->winning_team_id) == $team->id ? 'selected' : '' }}>{{ $team->long_name }}</option>
                @endforeach
            </select>
        </label>
        @error('winning_team_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Update Fixture</button>
    </form>
@endsection
