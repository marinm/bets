@extends('layouts.app')

@section('title', 'Fixtures')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">Fixtures</h1>   
        <a href="{{ route('fixtures.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Create</a>
    </div>

    <div class="flex flex-col gap-4">
        @foreach ($fixtures as $fixture)
            <a href="{{ route('fixtures.show', ['fixture' => $fixture]) }}" class="bg-gray-800 p-4 rounded flex justify-between items-center">
                <div class="flex-1">
                    <h2 class="text-white text-lg font-bold">{{ $fixture->team1->long_name }} vs {{ $fixture->team2->long_name }}</h2>
                    <p class="text-gray-400">{{ $fixture->started_at->format('Y-m-d H:i') }}</p>
                </div>
                <p class="text-gray-400">{{ $fixture->is_finished ? 'Finished' : 'Upcoming' }}</p>
            </a>
        @endforeach
    </div>
@endsection
