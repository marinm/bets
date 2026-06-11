@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    @auth
        <div class="w-full py-4 flex justify-between items-center mb-4">
            <span class="text-white mr-4">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-500">Logout</button>
            </form>
        </div>
    @endauth
    <div class="flex flex-col gap-4">
        @foreach ($fixtures as $fixture)
            <a href="{{ route('fixture-bets.create', ['fixture' => $fixture]) }}" class="bg-gray-800 p-4 rounded-xl flex justify-between items-center">
                <div class="flex-1">
                    <p class="text-white text-lg font-bold truncate">{{ $fixture->team1->long_name }}</p>
                    <p class="text-white text-lg font-bold truncate">{{ $fixture->team2->long_name }}</p>
                    <p class="text-gray-400">{{ $fixture->started_at->format('Y-m-d H:i') }} - {{ $fixture->is_finished ? 'Finished' : 'Upcoming' }}</p>
                    <p class="text-gray-400">{{ $fixture->bets_count }} {{ Str::plural('bet', $fixture->bets_count) }}</p>
                </div>
                @if ($fixture->bets->isNotEmpty())
                    <p class="text-green-400">Bet Placed</p>
                @endif
                
            </a>
        @endforeach
    </div>
@endsection
