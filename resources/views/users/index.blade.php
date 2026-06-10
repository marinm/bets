@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-white text-2xl font-bold">Users</h1>   
        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Create</a>
    </div>

    @session('errors')
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('errors')->first() }}
        </div>
    @endsession

    <div class="flex flex-col gap-4">
        @foreach ($users as $user)
            <a href="{{ route('users.show', ['user' => $user]) }}" class="bg-gray-800 p-4 rounded flex justify-between items-center">
                <div class="flex-1">
                    <h2 class="text-white text-lg font-bold">{{ $user->name }}</h2>
                    <p class="text-gray-400">{{ $user->internal_name }} - Balance: {{ number_format($user->balance_cents / 100, 2) }}</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection
