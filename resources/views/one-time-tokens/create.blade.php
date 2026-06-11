@extends('layouts.app')

@section('title', 'Create One-Time Token')

@section('content')
    <a href="{{ route('one-time-tokens.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">One-Time Tokens</a>
    <h1 class="text-white text-2xl font-bold mb-6">Create a One-Time Token</h1>

    <form action="{{ route('one-time-tokens.store') }}" method="POST">
        @method('POST')
        @csrf
        <div class="border border-white rounded">
            @foreach ($users as $user)
            <label class="p-2 block text-white">
                <input type="radio" name="user_id" value="{{ $user->id }}" />
                {{ $user->name }}
            </label>
            @endforeach
        </div>
        @error('user_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Create Token</button>
    </form>
@endsection
