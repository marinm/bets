@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <div class="w-full py-4 flex justify-end items-center mb-4 text-white">
        <a href="{{ route('profile.show') }}" class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
        </a>
    </div>
    <div class="flex flex-col gap-4">
        @foreach ($fixtures as $fixture)
            @php
                $url = $fixture->bets_exists
                    ? route('fixture-bets.index', $fixture)
                    : route('fixture-bets.create', $fixture)
            @endphp
            <a href="{{ $url }}" class="bg-gray-900 p-4 rounded-xl flex justify-between items-center gap-4">
                <p class="text-gray-400 font-mono">{{ $fixture->started_at->format('M d') }}</p>
                <div class="text-2xl font-mono text-white">
                    <span class="fi fi-{{ strtolower($fixture->team1->country_code) }}"></span>
                    -
                    <span class="fi fi-{{ strtolower($fixture->team2->country_code) }}"></span>
                </div>
                <p class="text-gray-400 font-mono">{{ $fixture->bets_count }}</p>
            </a>
        @endforeach
    </div>
@endsection
