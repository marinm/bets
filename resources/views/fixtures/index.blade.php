@extends('layouts.app')

@section('title', 'Fixtures')

@section('content')
    <x-back-to-admin-menu />

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">Fixtures</h1>   
        <a href="{{ route('fixtures.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Create</a>
    </div>

    <div class="border border-gray-800 rounded-lg overflow-hidden text-white font-mono">
        @foreach ($fixtures as $fixture)
            <a href="{{ route('fixtures.show', ['fixture' => $fixture]) }}" class="border-b border-gray-800 p-4 rounded flex justify-between items-center">
                <div class="w-full flex justify-between">
                    <div>{{ $fixture->started_at_local->format('M d h:i A') }}</div>
                    <div>
                        {{ $fixture->team1->country_code }} -
                        {{ $fixture->team2->country_code }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
