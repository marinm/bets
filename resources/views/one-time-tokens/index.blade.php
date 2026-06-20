@extends('layouts.app')

@section('title', 'One-Time Tokens')

@section('content')
    <x-back-to-admin-menu />

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">One-Time Tokens</h1>   
        <a href="{{ route('one-time-tokens.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Create</a>
    </div>

    <div class="flex flex-col border border-white rounded">
        @foreach ($oneTimeTokens as $oneTimeToken)
            <a href="{{ route('one-time-tokens.show', $oneTimeToken) }}" class="border-b border-white p-4 flex justify-between items-center">
                <p class="text-white text-lg font-bold">{{ $oneTimeToken->user->name }}</p>
                <p class="text-gray-400">{{ $oneTimeToken->created_at->diffForHumans() }}</p>
            </a>
        @endforeach
    </div>
@endsection
