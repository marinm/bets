@extends('layouts.app')

@section('title', config('app.name'))

@section('content')
    <div class="flex flex-col justify-start items-start gap-4">
        <a href="{{ route('teams.index') }}" class="w-full text-white mb-4 inline-block border border-whites p-4 rounded">Teams</a>
    </div>
@endsection
