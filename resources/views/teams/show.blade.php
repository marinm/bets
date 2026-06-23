@extends('layouts.app')

@section('title', 'Team')

@section('content')
    <a href="{{ route('teams.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">Teams</a>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">Team</h1>
        <a href="{{ route('teams.edit', ['team' => $team]) }}" class="px-4 py-2 bg-blue-500 text-white rounded">Edit</a>
    </div>

    <div class="bg-gray-800 p-4 rounded">
        <p class="text-gray-400">Country Code: {{ $team->country_code }}</p>
        <p class="text-gray-400">Long Name: {{ $team->long_name }}</p>
        <p class="text-gray-400">Flag Code: {{ $team->flag_code }}</p>
    </div>

    <form action="{{ route('teams.destroy', ['team' => $team]) }}" method="POST" class="mt-4">
        @method('DELETE')
        @csrf
        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded">Delete</button>
    </form>
@endsection
