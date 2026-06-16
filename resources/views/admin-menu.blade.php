@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <h1 class="text-white font-bold my-4">Admin menu</h1>
    <div class="border border-white rounded flex flex-col justify-start items-start">
        <a href="{{ route('bets.index') }}" class="w-full text-white inline-block border-b border-white p-4">Bets</a>
        <a href="{{ route('fixtures.index') }}" class="w-full text-white inline-block border-b border-white p-4">Fixtures</a>
        <a href="{{ route('one-time-tokens.index') }}" class="w-full text-white inline-block border-b p-4">One-Time Tokens</a>
        <a href="{{ route('teams.index') }}" class="w-full text-white inline-block border-b border-white p-4">Teams</a>
        <a href="{{ route('users.index') }}" class="w-full text-white inline-block border-white p-4">Users</a>
    </div>
@endsection
