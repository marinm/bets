@extends('layouts.app')

@section('title', 'Teams')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">Teams</h1>   
        <a href="{{ route('teams.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Create</a>
    </div>

    <div class="flex flex-col gap-4">
        @foreach ($teams as $team)
            <a href="{{ route('teams.show', ['team' => $team]) }}" class="bg-gray-800 p-4 rounded flex justify-between items-center">
                <h2 class="text-white text-lg font-bold">{{ $team->long_name }}</h2>
                <p class="text-gray-400">{{ $team->country_code }}</p>
            </a>
        @endforeach
    </div>
@endsection
