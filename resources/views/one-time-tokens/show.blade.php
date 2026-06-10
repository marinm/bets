@extends('layouts.app')

@section('title', 'One-Time Token')

@section('content')
    <a href="{{ route('one-time-tokens.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">One-Time Tokens</a>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">One-Time Token</h1>
        <a href="{{ route('one-time-tokens.edit', $oneTimeToken) }}" class="px-4 py-2 bg-blue-500 text-white rounded">Edit</a>
    </div>

    <div class="bg-gray-800 p-4 rounded">
        <p class="text-gray-400">User: {{ $oneTimeToken->user->name }}</p>
        <p class="text-gray-400">Secret: {{ $oneTimeToken->secret }}</p>
        <p class="text-gray-400">
            Sign-in Link:
            <a href="{{ route('sessions.create', ['oneTimeToken' => $oneTimeToken->secret]) }}" class="text-blue-500 hover:text-blue-400">
                {{ route('sessions.create', ['oneTimeToken' => $oneTimeToken->secret]) }}
            </a>
        </p>
        <p class="text-gray-400">Created: {{ $oneTimeToken->created_at->format('Y-m-d H:i') }}</p>
    </div>

    <form action="{{ route('one-time-tokens.destroy', $oneTimeToken) }}" method="POST" class="mt-4">
        @method('DELETE')
        @csrf
        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded">Delete</button>
    </form>
@endsection
