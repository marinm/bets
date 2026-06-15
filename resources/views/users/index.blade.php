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

    <div class="flex flex-col border border-white rounded">
        @foreach ($users as $user)
            <a href="{{ route('users.show', ['user' => $user]) }}" class="p-4 flex justify-between items-center border-b border-white last:border-b-0">
                <div class="flex-1">
                    <h2 class="text-white text-lg font-bold">{{ $user->name }}</h2>
                </div>
            </a>
        @endforeach
    </div>
@endsection
