@extends('layouts.app')

@section('title', 'Edit Fixture')

@section('content')
    <a href="{{ route('fixtures.index') }}" class="text-gray-400 hover:text-amber-900 mb-4 inline-block">Fixtures</a>
    <h1 class="text-amber-900 text-2xl font-bold mb-6">Edit Fixture</h1>

    <form action="{{ route('fixtures.update', ['fixture' => $fixture]) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="border border-white rounded">
            <div class="flex items-center justify-between p-4 border-b border-white">
                <span class="text-amber-900">Team 1</span>
                <span class="text-gray-400">{{ $fixture->team1->long_name }}</span>
            </div>
            <div class="flex items-center justify-between p-4">
                <span class="text-amber-900">Team 2</span>
                <span class="text-gray-400">{{ $fixture->team2->long_name }}</span>
            </div>
        </div>

        <label class="flex flex-col text-amber-900 mt-4">
            Started at
            <input type="datetime-local" name="started_at" value="{{ old('started_at', $fixture->started_at_local->format('Y-m-d\TH:i')) }}" class="w-full p-2 text-amber-900 bg-black border border-white" />
        </label>
        @error('started_at')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <div class="text-amber-900 mt-4">
            Winning Team
            <div class="w-full text-amber-900 bg-black border border-white rounded">
                <label class="block p-4 w-full border-b border-white">
                    <input
                        type="radio"
                        name="winner_team_id"
                        value=""
                        @checked(is_null(old('winner_team_id', $fixture->winner_team_id)))
                    />
                    None
                </label>
                <label class="block p-4 w-full border-b border-white">
                    <input
                        type="radio"
                        name="winner_team_id"
                        value="{{ $fixture->team1->id }}"
                        @checked(old('winner_team_id', $fixture->winner_team_id) == $fixture->team1->id)
                    />
                    {{ $fixture->team1->long_name }}
                </label>
                <label class="block p-4 w-full border-b border-white">
                    <input
                        type="radio"
                        name="winner_team_id"
                        value="{{ $fixture->team2->id }}"
                        @checked(old('winner_team_id', $fixture->winner_team_id) == $fixture->team2->id)
                    />
                    {{ $fixture->team2->long_name }}
                </label>
            </div>
        </label>
        @error('winner_team_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <div class="text-amber-900 mt-4">
            Can draw
            <div class="w-full text-amber-900 bg-black border border-white rounded">
                <label class="block p-4 w-full text-amber-900 border-b border-white">
                    <input type="radio" name="can_draw" value="1" @checked($fixture->can_draw) />
                    Yes
                </label>
                <label class="block p-4 w-full text-amber-900">
                    <input type="radio" name="can_draw" value="0" @checked(!$fixture->can_draw) />
                    No
                </label>
            </div>
        </label>
        @error('can_draw')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label class="flex items-center text-amber-900 p-4 border border-white rounded mt-4">
            <input type="checkbox" name="is_finished" value="1" @checked(old('is_finished', $fixture->is_finished)) }} class="mr-2" />
            Is Finished
        </label>

        @error('is_finished')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-amber-900 rounded">Update Fixture</button>
    </form>
@endsection
