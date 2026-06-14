@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <div class="w-full py-4 flex justify-between items-center mb-4 text-white">
        <span>{{ $user->bets_count }} {{ Str::plural('bet', $user->bets_count) }} placed</span>
        <a href="{{ route('profile.show') }}" class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
        </a>
    </div>
    <div class="flex flex-col gap-4">
        @foreach ($fixtures as $fixture)
            <a href="{{ route('fixture-bets.create', ['fixture' => $fixture]) }}" class="bg-gray-800 p-4 rounded-xl">
                <p class="text-white text-lg font-bold truncate">
                    <span class="fi fi-{{ strtolower($fixture->team1->country_code) }}"></span>
                    {{ $fixture->team1->long_name }}
                </p>
                <p class="text-white text-lg font-bold truncate">
                    <span class="fi fi-{{ $fixture->team2->country_code }}"></span>
                    {{ $fixture->team2->long_name }}
                </p>
                <div class="flex justify-between items-center mt-2">
                    <p class="text-gray-400">{{ $fixture->started_at->format('D, M d g:i A') }}</p>
                    @if ($fixture->bets->isNotEmpty())
                        <p class="text-green-400">Bet Placed</p>
                    @endif
                    <p class="text-gray-400">{{ $fixture->bets_count }} {{ Str::plural('bet', $fixture->bets_count) }}</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection
