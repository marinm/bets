@extends('layouts.app')

@section('title', 'Edit One-Time Token')

@section('content')
    <a href="{{ route('one-time-tokens.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">One-Time Tokens</a>
    <h1 class="text-white text-2xl font-bold mb-6">Edit One-Time Token</h1>

    <form action="{{ route('one-time-tokens.update', $oneTimeToken) }}" method="POST">
        @method('PUT')
        @csrf
        <label class="flex flex-col text-white">
            User
            <select name="user_id" class="w-full p-2 text-white bg-black border border-white">
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $oneTimeToken->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </label>
        @error('user_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded">Update Token</button>
    </form>
@endsection
