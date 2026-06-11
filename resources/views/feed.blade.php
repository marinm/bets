@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">Fixtures</h1>   
    </div>

    <div class="flex flex-col gap-4">
        @foreach ($fixtures as $fixture)
            <a href="{{ route('fixture-bets.create', ['fixture' => $fixture]) }}" class="bg-gray-800 p-4 rounded flex justify-between items-center">
                <div class="flex-1">
                    <p class="text-white text-lg font-bold truncate">{{ $fixture->team1->long_name }}</p>
                    <p class="text-white text-lg font-bold truncate">{{ $fixture->team2->long_name }}</p>
                    <p class="text-gray-400">{{ $fixture->started_at->format('Y-m-d H:i') }}</p>
                </div>
                <p class="text-gray-400">{{ $fixture->is_finished ? 'Finished' : 'Upcoming' }}</p>
            </a>
        @endforeach
    </div>
@endsection
