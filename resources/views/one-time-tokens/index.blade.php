@extends('layouts.app')

@section('title', 'One-Time Tokens')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">One-Time Tokens</h1>   
        <a href="{{ route('one-time-tokens.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Create</a>
    </div>

    <div class="flex flex-col gap-4">
        @foreach ($oneTimeTokens as $oneTimeToken)
            <a href="{{ route('one-time-tokens.show', $oneTimeToken) }}" class="bg-gray-800 p-4 rounded flex justify-between items-center">
                <div class="flex-1">
                    <h2 class="text-white text-lg font-bold">{{ $oneTimeToken->user->name }}</h2>
                    <p class="text-gray-400">Secret: {{ $oneTimeToken->secret }}</p>
                    <p class="text-gray-400">Created: {{ $oneTimeToken->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection
