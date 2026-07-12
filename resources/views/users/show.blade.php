@extends('layouts.app')

@section('title', 'User')

@section('content')
    <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-amber-900 mb-4 inline-block">Users</a>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-amber-900 text-2xl font-bold">User</h1>
        <a href="{{ route('users.edit', ['user' => $user]) }}" class="px-4 py-2 bg-blue-500 text-amber-900 rounded">Edit</a>
    </div>

    <div class="bg-gray-800 p-4 rounded">
        <p class="text-gray-400">Name: {{ $user->name }}</p>
        <p class="text-gray-400">Internal Name: {{ $user->internal_name }}</p>
        <p class="text-gray-400">Balance: {{ number_format($user->balance_cents / 100, 2) }}</p>
        <p class="text-gray-400">Admin: {{ $user->is_admin ? 'Yes' : 'No' }}</p>
    </div>

    <form action="{{ route('users.destroy', ['user' => $user]) }}" method="POST" class="mt-4">
        @method('DELETE')
        @csrf
        <button type="submit" class="w-full px-4 py-2 bg-red-500 text-amber-900 rounded">Delete</button>
    </form>
@endsection
