@extends('layouts.app')

@section('title', 'Create One-Time Token')

@section('content')
    <x-back-link />
    <h1 class="text-white text-2xl font-bold mb-6">Create a One-Time Token</h1>

    <form action="{{ route('one-time-tokens.store') }}" method="POST">
        @method('POST')
        @csrf
        <div class="border border-white rounded">
            @foreach ($users as $user)
            <label class="flex items-center p-4 block text-white border-b border-white">
                <input type="radio" name="user_id" value="{{ $user->id }}" class="mr-2" />
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
