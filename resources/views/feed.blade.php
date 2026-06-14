@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <div class="w-full py-4 flex justify-between items-center mb-4">
        <span class="text-white mr-4">{{ $user->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-gray-500">Logout</button>
        </form>
    </div>
    <div class="text-white mb-4">
        {{ $user->bets_count }} {{ Str::plural('bet', $user->bets_count) }} placed
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
