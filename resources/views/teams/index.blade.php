@extends('layouts.app')

@section('title', 'Teams')

@section('content')
    <x-back-to-admin-menu />

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">Teams</h1>   
        <a href="{{ route('teams.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Create</a>
    </div>

    <div class="flex flex-col border border-white rounded text-white">
        @foreach ($teams as $team)
            <a href="{{ route('teams.show', ['team' => $team]) }}" class="border-b border-white p-4 flex justify-between items-center">
                <h2 class="">{{ $team->long_name }}</h2>
                <div class="flex items-center gap-2">
                    <p class="font-mono">{{ $team->country_code }}</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection
