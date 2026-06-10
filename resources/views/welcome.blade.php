@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <div class="flex flex-col justify-start items-start gap-1">
        <a href="{{ route('users.index') }}" class="w-full text-white mb-4 inline-block border border-whites p-4 rounded">Users</a>
        <a href="{{ route('teams.index') }}" class="w-full text-white mb-4 inline-block border border-whites p-4 rounded">Teams</a>
        <a href="{{ route('fixtures.index') }}" class="w-full text-white mb-4 inline-block border border-whites p-4 rounded">Fixtures</a>
        <a href="{{ route('bets.index') }}" class="w-full text-white mb-4 inline-block border border-whites p-4 rounded">Bets</a>
    </div>
@endsection
